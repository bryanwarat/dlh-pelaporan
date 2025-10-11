<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    public function index()
    {
        return view('pages.admin.news.index');
    }

    public function getData(Request $request)
    {
        $query = News::select('news.*', 'users.name as creator_name')
                     ->leftJoin('users', 'news.created_by', '=', 'users.id');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('view', function ($row) {
                // Kolom untuk tautan ke halaman publik (View)
                // Asumsi rute detail publik Anda adalah 'public.information.detail' yang menerima slug
                $viewUrl = route('public.information.detail', $row->slug);
                
                return '<a href="'.$viewUrl.'" target="_blank" class="btn btn-sm btn-secondary"><i class="mdi mdi-eye"></i> Lihat</a>';
            })
            ->addColumn('action', function ($row) {
                // Kolom untuk Aksi Admin (Detail, Edit, Hapus)
                $detailUrl = route('admin.news.detail', $row->slug); // Menggunakan slug
                $editUrl = route('admin.news.edit', $row->id);
                $deleteUrl = route('admin.news.destroy', $row->id);
                
                return '
                    <a href="'.$detailUrl.'" class="btn btn-sm btn-info me-1">Detail</a>
                    <a href="'.$editUrl.'" class="btn btn-sm btn-warning me-1">Edit</a>
                    <form method="POST" action="'.$deleteUrl.'" style="display:inline-block;">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</button>
                    </form>
                ';
            })
            ->editColumn('status', function($row){
                return $row->status == 1 
                       ? '<span class="badge bg-success">Publish</span>' 
                       : '<span class="badge bg-warning">Draft</span>';
            })
            ->editColumn('created_by', function($row){
                return $row->creator_name ?? '-';
            })
            ->rawColumns(['action', 'status', 'view']) // Tambahkan 'view' dan 'status'
            ->make(true);
    }

    // ... (Metode create, store, edit, update, detail, destroy lainnya)
    public function create()
    {
        return view('pages.admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'thumbnail' => 'nullable|image|max:2048',
            'content' => 'required|string',
        ]);

        try {
            $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
            $data['created_by'] = Auth::id();

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
            }

            News::create($data);

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan berita: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('pages.admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'thumbnail' => 'nullable|image|max:2048',
            'content' => 'required|string',
        ]);

        try {
            $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

            if ($request->hasFile('thumbnail')) {
                if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
                }
                $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
            }

            $news->update($data);

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate berita: ' . $e->getMessage());
        }
    }

    public function detail($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('pages.admin.news.detail', compact('news'));
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}