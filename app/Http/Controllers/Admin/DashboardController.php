<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint; // Pastikan Anda mengimpor model Complaint

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total pengaduan berdasarkan status
        $totalComplaints = Complaint::count();
        $totalSelesai = Complaint::where('status', 2)->count(); // Status 2 = Selesai
        $totalDiproses = Complaint::where('status', 1)->count(); // Status 1 = Sedang Diproses
        $totalDitolak = Complaint::where('status', 3)->count(); // Status 3 = Ditolak
        $totalBelumDiproses = Complaint::where('status', 0)->count(); // Status 0 = Belum Diproses

        // Mengirimkan semua data total ke view
        return view('pages.admin.dashboard.index', compact(
            'totalComplaints',
            'totalSelesai',
            'totalDiproses',
            'totalDitolak',
            'totalBelumDiproses'
        ));
    }
}