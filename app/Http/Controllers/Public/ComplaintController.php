<?php

namespace App\Http\Controllers\Public;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\ComplaintCategory;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    public function index()
    {
        $categories = ComplaintCategory::all();

        return view('pages.public.complaint', compact('categories'));
    }

    public function store(request $request)
    {
        $complaint = Complaint::create([
            'category_id'    => $request->input('category_id'),
            'name'           => $request->input('name'),
            'nik'            => $request->input('nik'),
            'phone'          => $request->input('phone'),
            'address'        => $request->input('address'),
            'email'          => $request->input('email'),
            'complaint'      => $request->input('complaint'),
            'complaint_link' => $request->input('complaint_link'),
            'location'       => $request->input('location'),
            'lat'            => $request->input('lat'),
            'long'           => $request->input('long'),
            'status'         => '0',
        ]);


        return redirect()->route('public.complaint')->with('success', 'Success');

    }
}
