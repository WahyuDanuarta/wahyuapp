<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Flashsale; 
use RealRashid\SweetAlert\Facades\Alert; // Pastikan ini ada
use App\Models\Admin; // Model Admin

class AdminController extends Controller
{
    public function detail($id)
    {
        // Mengambil data admin berdasarkan ID
        $admin = Admin::find($id);

        // Memeriksa apakah admin ditemukan
        if (!$admin) {
            return redirect()->route('admins.detail')->with('error', 'Admin not found.');
        }

        // Mengembalikan tampilan dengan data admin
        return view('pages.admin.admins.detail', compact('admin'));
    }
    public function dashboard()
    {
        $products = Product::count();
        $users = User::count();
        $distributors = Distributor::count();
        $flashsales = Flashsale::count();
        $admins = Admin::count();

        return view('pages.admin.index', compact('products', 'distributors', 'users', 'flashsales','admins'));
    }

    // Menampilkan semua admin
    public function index()
    {
        $admins = Admin::all();

        // Menampilkan notifikasi jika ada
        if (session('success')) {
            Alert::success('Berhasil!', session('success'));
        }

        if (session('error')) {
            Alert::error('Error!', session('error'));
        }

        return view('pages.admin.admins.index', compact('admins'));
    }

    // Menampilkan formulir untuk membuat admin baru
    public function create()
    {
        return view('pages.admin.admins.create');
    }

    // Menyimpan admin baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Kembali ke index dengan notifikasi
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    // Menampilkan formulir untuk mengedit admin
    public function edit($id)
    {
        $admin = Admin::find($id);
        
        if (!$admin) {
            return redirect()->route('admin.admins.index')->with('error', 'Admin tidak ditemukan.');
        }

        return view('pages.admin.admins.edit', compact('admin'));
    }

    // Memperbarui admin yang sudah ada
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        
        if (!$admin) {
            return redirect()->route('admin.admins.index')->with('error', 'Admin tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $id,
            'email' => 'required|email|max:255|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $admin->password,
        ]);

        // Kembali ke index dengan notifikasi
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diperbarui.');
    }

    // Menghapus admin dari database
    public function delete($id)
    {
        $admin = Admin::find($id);
        
        if (!$admin) {
            return redirect()->route('admin.admins.index')->with('error', 'Admin tidak ditemukan.');
        }
        
        $admin->delete();

        // Kembali ke index dengan notifikasi
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus.');
    }

    // Menampilkan konfirmasi penghapusan
    public function confirmDelete($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.confirm_delete', compact('admin'));
    }
}