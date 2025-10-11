<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Exception;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua pengguna admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.admin.users.index');
    }

    /**
     * Mengambil data pengguna untuk DataTables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function usersData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('level', 1)
                        ->where('email', '!=', 'email@admin.com')
                        ->select(['id', 'name', 'email', 'level', 'created_at']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->translatedFormat('d F Y, H:i');
                })
                ->editColumn('level', function ($row) {
                    return '<span class="badge bg-primary">Admin</span>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.users.edit', $row->id);
                    $deleteUrl = route('admin.users.destroy', $row->id);

                    // Pastikan user tidak bisa menghapus atau mengedit akunnya sendiri
                    $canModify = $row->id !== Auth::id();

                    $buttons = '';
                    if ($canModify) {
                        $buttons .= '<a href="'.$editUrl.'" class="btn btn-warning btn-sm me-1"><i class="mdi mdi-pencil"></i> Edit</a>';
                        $buttons .= '
                            <form action="'.$deleteUrl.'" method="POST" style="display:inline;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus pengguna ini?\');">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-trash-can-outline"></i> Hapus
                                </button>
                            </form>';
                    }
                    
                    return $buttons;
                })
                ->rawColumns(['action', 'level'])
                ->make(true);
        }
        return response()->json(['error' => 'Not Ajax'], 400);
    }
    
    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 1,
            ]);
            return redirect()->route('admin.users.index')->with('success', 'Pengguna admin berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat mengedit akun Anda sendiri dari sini.');
        }
        return view('pages.admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        try {
            $user->name = $validated['name'];
            $user->email = $validated['email'];

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        
    try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Pengguna admin berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}