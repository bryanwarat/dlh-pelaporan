<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News; // Pastikan Anda mengimpor model News

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 berita terbaru dari tabel 'news'
        $informations = News::orderBy('created_at', 'desc')->where('status', '1')->take(6)->get();
        
        return view('pages.public.home', compact('informations'));
    }

    public function infomationIndex()
    {
        // Ambil 3 berita terbaru dari tabel 'news'
        $informations = News::orderBy('created_at', 'desc')->where('status', '1')->get();
        
        return view('pages.public.information', compact('informations'));
    }

    public function informationDetail($slug)
    {
        $information = News::where('slug', $slug)->firstOrFail();
        $latestNews = News::orderBy('created_at', 'desc')->where('status', '1')->get();
        

        return view('pages.public.informationDetail', compact('information', 'latestNews'));
    }

}