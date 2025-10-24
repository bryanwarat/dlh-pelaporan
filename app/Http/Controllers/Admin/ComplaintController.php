<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\ComplaintFile;
use App\Models\StatusHistory;
use App\Models\ComplaintCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{
    // ======================
    // DATA COMPLAINT
    // ======================
    public function index()
    {
        $complaints = Complaint::all();
        return view('pages.admin.complaint.index', compact('complaints'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Complaint::select(
                'complaints.id',
                'complaints.name',
                'complaints.nik',
                'complaints.phone',
                'complaints.email',
                'complaints.complaint',
                'complaints.location',
                'complaints.status',
                'complaint_categories.category',
                'complaints.created_at'
            )
            ->leftJoin('complaint_categories', 'complaints.category_id', '=', 'complaint_categories.id');
            // ->orderBy('complaints.id', 'desc'); // Akan diatur oleh DataTables

            // ======================================
            // LOGIKA FILTER TAMBAHAN
            // ======================================
            
            // 1. Filter Status
            if ($request->filled('status')) {
                $data->where('complaints.status', $request->status);
            }

            // 2. Filter Rentang Tanggal
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                
                $data->whereBetween('complaints.created_at', [$startDate, $endDate]);
            }
            // ======================================
            // END LOGIKA FILTER TAMBAHAN

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->translatedFormat('d F Y');
                })
                ->editColumn('status', function ($row) {
                    // Penentuan tampilan badge status yang lebih rapi
                    return match ((string) $row->status) {
                        '1' => '<span class="badge bg-info">Sedang Diproses</span>',
                        '2' => '<span class="badge bg-success">Selesai</span>',
                        '3' => '<span class="badge bg-danger">Ditolak</span>',
                        default => '<span class="badge bg-warning">Belum Diproses</span>',
                    };
                })
                ->editColumn('complaint', function ($row) {
                    return \Illuminate\Support\Str::limit($row->complaint, 50, '...');
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('admin.complaint.detail', $row->id).'" class="btn btn-sm btn-primary"><i class="fas fa-eye me-1"></i> Detail</a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function complaintDetail($id)
    {
        $complaint = Complaint::select(
                'complaints.*',
                'complaint_categories.category'
            )
            ->leftJoin('complaint_categories', 'complaints.category_id', '=', 'complaint_categories.id')
            ->where('complaints.id', $id)
            ->firstOrFail();

        $files = ComplaintFile::where('complaint_id', $id)->get();
        
        $histories = StatusHistory::where('complaint_id', $id)
            ->leftJoin('users as u', 'status_histories.status_by', '=', 'u.id')
            ->select('status_histories.*', 'u.name as user_name')
            ->orderBy('status_histories.created_at', 'desc')
            ->get();
            
        return view('pages.admin.complaint.detail', compact('complaint', 'files', 'histories'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
            'note' => 'nullable|string',
        ]);
    
        DB::beginTransaction();
        try {
            $complaint = Complaint::findOrFail($id);
            $complaint->status = $request->status;
            $complaint->save();
    
            $user = Auth::user();

            StatusHistory::create([
                'complaint_id' => $id,
                'status' => $request->status,
                'note' => $request->note,
                'status_by' => $user->id, // Menyimpan ID user yang login
            ]);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Status pengaduan berhasil diperbarui!'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Complaint Status Update Failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    // ======================
    // CATEGORY
    // ======================
    public function complaintCategory()
    {
        return view('pages.admin.complaint.category.index');
    }

    public function getCategoryData(Request $request)
    {
        if ($request->ajax()) {
            $data = ComplaintCategory::select('id', 'category')->orderBy('id', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn  = '<a href="'.route('admin.complaint.category.edit', $row->id).'" class="btn btn-sm btn-warning">Edit</a> ';
                    $btn .= '<form action="'.route('admin.complaint.category.destroy', $row->id).'" method="POST" style="display:inline-block;">'
                              . csrf_field() . method_field('DELETE')
                              . '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</button></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function updateHistoryNote(Request $request, $id)
    {
        $request->validate([
            'note' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Find the specific status history record
            $history = StatusHistory::findOrFail($id);
            
            // Simpan catatan baru
            $history->note = $request->note;
            $history->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Catatan riwayat status berhasil diperbarui.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Status History Note Update Failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui catatan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function complaintCategoryCreate()
    {
        return view('pages.admin.complaint.category.create');
    }

    public function complaintCategoryStore(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        ComplaintCategory::create([
            'category' => $request->input('category'),
        ]);

        return redirect()->route('admin.complaint.category.index')->with('success', 'Kategori pengaduan berhasil ditambahkan.');
    }

    public function complaintCategoryEdit($id)
    {
        $category = ComplaintCategory::findOrFail($id);
        return view('pages.admin.complaint.category.edit', compact('category'));
    }

    public function complaintCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $category = ComplaintCategory::findOrFail($id);
        $category->update([
            'category' => $request->input('category'),
        ]);

        return redirect()->route('admin.complaint.category.index')->with('success', 'Kategori pengaduan berhasil diperbarui.');
    }

    public function complaintCategoryDestroy($id)
    {
        $category = ComplaintCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.complaint.category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}