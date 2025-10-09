<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use App\Models\ComplaintFile;
use App\Models\ComplaintCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return view('pages.admin.complaint.detail', compact('complaint', 'files'));
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
