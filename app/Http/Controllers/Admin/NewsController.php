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
        ->addColumn('action', function ($row) {
            $editUrl = route('admin.news.edit', $row->id);
            $detailUrl = route('admin.news.show', $row->id);
            $deleteUrl = route('admin.news.destroy', $row->id);
            return '
                <a href="'.$detailUrl.'" class="btn btn-sm btn-info">Detail</a>
                <a href="'.$editUrl.'" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="'.$deleteUrl.'" style="display:inline-block;">
                    '.csrf_field().method_field('DELETE').'
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</button>
                </form>
            ';
        })
        ->editColumn('status', function($row){
            return $row->status ? 'Publish' : 'Draft';
        })
        ->editColumn('created_by', function($row){
            return $row->creator_name ?? '-';
        })
        ->rawColumns(['action'])
        ->make(true);
}

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

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['created_by'] = Auth::id();
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dibuat.');
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

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('pages.admin.news.show', compact('news'));
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
