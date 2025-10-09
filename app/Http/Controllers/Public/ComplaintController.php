<?php

namespace App\Http\Controllers\Public;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\ComplaintFile;
use App\Models\ComplaintCategory;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    public function index()
    {
        $categories = ComplaintCategory::all();

        return view('pages.public.complaint', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required',
            'name'           => 'required|string',
            'nik'            => 'required|string',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'email'          => 'required|email',
            'complaint'      => 'required|string',
            'complaint_link' => 'nullable|string',
            'location'       => 'nullable|string',
            'lat'            => 'nullable',
            'long'           => 'nullable',
            'files.*'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Simpan pengaduan
        $complaint = Complaint::create([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'nik'            => $request->nik,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'email'          => $request->email,
            'complaint'      => $request->complaint,
            'complaint_link' => $request->complaint_link,
            'location'       => $request->location,
            'lat'            => $request->lat,
            'long'           => $request->long,
            'status'         => '0',
        ]);

        // Simpan file jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                $path = $uploadedFile->store('complaints', 'public');

                ComplaintFile::create([
                    'complaint_id'   => $complaint->id,
                    'complaint_file' => $path,
                ]);
            }
        }

        return redirect()
            ->route('public.complaint')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }
}
