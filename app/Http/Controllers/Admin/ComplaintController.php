<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('pages.admin.complaint.index');
    }

    public function complaintCategory()
    {
        return view('pages.admin.complaint.category.index');
    }
}
