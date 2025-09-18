<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\ComplaintCategory;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        return view('pages.admin.complaint.index', compact('complaints'));
    }

    public function complaintDetail($id)
    {
        $complaint = Complaint::join('complaint_categories', 'complaints.category_id', 'complaint_categories.id')->where('complaints.id', $id)->first();
        return view('pages.admin.complaint.detail', compact('complaint'));
    }
    

    public function complaintCategory()
    {
        $categories = ComplaintCategory::all();

        return view('pages.admin.complaint.category.index', compact('categories'));
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

        return redirect()->route('admin.complaint.category')->with('success', 'Kategori pengaduan berhasil ditambahkan.');
    }

    
}
