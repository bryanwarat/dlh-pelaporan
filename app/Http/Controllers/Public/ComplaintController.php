<?php

namespace App\Http\Controllers\Public;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\ComplaintFile;
use App\Models\StatusHistory;
use App\Models\ComplaintCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    /**
     * Tampilkan form pelaporan (index yang sudah ada).
     */
    public function index()
    {
        $categories = ComplaintCategory::all();

        return view('pages.public.complaint', compact('categories'));
    }

    /**
     * Simpan pengaduan (store yang sudah ada).
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required',
            'name'             => 'string',
            'nik'              => 'string',
            'phone'            => 'required|string',
            'address'          => 'string',
            'email'            => 'string',
            'complaint'        => 'required|string',
            'complaint_link'   => 'nullable|string',
            'location'         => 'nullable|string',
            'lat'              => 'nullable',
            'long'             => 'nullable',
            'files.*'          => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'is_anonim'        => 'nullable|boolean'
        ]);

        
        DB::beginTransaction();
        try {
            $complaint = Complaint::create([
            'category_id'      => $request->category_id,
            'name'             => $request->is_anonim ? 'Anonim' : $request->name,
            'nik'              => $request->is_anonim ? '-' : $request->nik,
            'phone'            => $request->phone,
            'address'          => $request->is_anonim ? '-' : $request->address,
            'email'            => $request->is_anonim ? '-' : $request->email,
            'complaint'        => $request->complaint,
            'complaint_link'   => $request->complaint_link,
            'location'         => $request->location,
            'lat'              => $request->lat,
            'long'             => $request->long,
            'status'           => '0',
        ]);

  
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                $path = $uploadedFile->store('complaints', 'public');

                ComplaintFile::create([
                    'complaint_id'   => $complaint->id,
                    'complaint_file' => $path,
                ]);
            }
        }

        DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Complaint Submission Failed: ' . $e->getMessage());
            return back()->withErrors('Terjadi kesalahan saat mengirim pengaduan. Silakan coba lagi.');
        }    

        return redirect()
            ->route('public.complaint')
            ->with('success', 'Pengaduan berhasil dikirim! Pihak kami akan mengirimkan update selanjutnya melaui data kontak yang anda kirimkan. Terima kasih.');
    }

    /**
     * Menampilkan daftar semua pelaporan untuk publik.
     */
    public function statusIndex()
    {
        // Mengambil semua pelaporan dengan pagination sederhana
        $complaints = Complaint::orderBy('created_at', 'desc')->paginate(10);
        
        return view('pages.public.complaint-list', compact('complaints'));
    }

    /**
     * Menampilkan detail pelaporan dan riwayat statusnya.
     * Asumsi menggunakan ID sebagai parameter.
     */
    public function statusShow($id)
    {
        $complaint = Complaint::findOrFail($id);
        $histories = StatusHistory::where('complaint_id', $complaint->id)
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        $complaint->histories = $histories;

        return view('pages.public.complaint-detail', compact('complaint'));
    }

    /**
     * Helper: Menerjemahkan status kode ke teks yang mudah dibaca.
     */
    private function getStatusText($status_code)
    {
        switch ((string)$status_code) {
            case '0':
                return '<span class="badge bg-warning">Menunggu Verifikasi</span>';
            case '1':
                return '<span class="badge bg-primary">Sedang Diproses</span>';
            case '2':
                return '<span class="badge bg-success">Selesai</span>';
            case '3':
                return '<span class="badge bg-danger">Ditolak</span>';
            default:
                return '<span class="badge bg-secondary">Status Tidak Dikenal</span>';
        }
    }
}
