<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use App\Models\ComplaintFile;
use App\Models\ComplaintCategory;
use App\Models\StatusHistory;
use App\Models\User; // Import model User
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;

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
                    'complaint_categories.category'
                )
                ->leftJoin('complaint_categories', 'complaints.category_id', '=', 'complaint_categories.id')
                ->orderBy('complaints.id', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 0
                        ? '<span class="badge bg-warning">Belum Diproses</span>'
                        : '<span class="badge bg-success">Selesai</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('admin.complaint.detail', $row->id).'" class="btn btn-sm btn-primary">Detail</a>';
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
        
        // Ambil data riwayat dan gabungkan dengan nama user
        $histories = StatusHistory::where('complaint_id', $id)
            ->leftJoin('users as u', 'status_histories.status_by', '=', 'u.id')
            ->select('status_histories.*', 'u.name as user_name')
            ->orderBy('status_histories.created_at', 'desc')
            ->get();
            
        return view('pages.admin.complaint.detail', compact('complaint', 'files', 'histories'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Pastikan validasi berjalan dengan baik dan mengembalikan JSON jika gagal
        $validated = $request->validate([
            'status' => 'required',
            'note' => 'nullable|string',
        ]);
    
        DB::beginTransaction();
        try {
            $complaint = Complaint::findOrFail($id);
            $complaint->status = $request->status;
            $complaint->save();
    
            $user = auth()->user();

            StatusHistory::create([
                'complaint_id' => $id,
                'status' => $request->status,
                'note' => $request->note,
                'status_by' => $user->id,
            ]);
    
            DB::commit();
    
            // KEMBALIKAN RESPONS JSON UNTUK SUKSES
            return response()->json([
                'success' => true,
                'message' => 'Status pengaduan berhasil diperbarui!'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Complaint Status Update Failed: ' . $e->getMessage());
            
            // KEMBALIKAN RESPONS JSON UNTUK ERROR
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