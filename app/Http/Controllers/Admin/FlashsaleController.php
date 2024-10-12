<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flashsale;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class FlashsaleController extends Controller
{
    
    public function index()
    {
        $flashsales = Flashsale::all();
        
        confirmDelete('Hapus Data!', 'apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.flashsale.index', compact('flashsales'));
    }

    public function create()
    {
        return view('pages.admin.flashsale.create');
    }

    public function detail($id)
    {
        $flashsales = Flashsale::findOrFail($id);
        return view('pages.admin.flashsale.detail', compact('flashsales'));
    }

    public function edit($id)
    {
        $flashsales = Flashsale::findOrFail($id);
        return view('pages.admin.flashsale.edit', compact('flashsales'));
    }

    //Menambahkan data flashsale
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'diskon_price' => 'numeric',
            'original_price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses upload gambar
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        }

        // Simpan produk
        $flashsales = Flashsale::create([
            'name' => $request->name,
            'diskon_price' => $request->diskon_price,
            'original_price' => $request->original_price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // Pengecekan apakah produk berhasil disimpan
        if ($flashsales) {
            Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
            return redirect()->route('admin.flashsale');
        } else {
            Alert::error('Gagal!', 'Produk gagal ditambahkan!');
            return redirect()->back();
        }
    }
    // update data product
    public function update(Request $request, $id)
        {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'diskon_price' => 'numeric',
            'original_price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mencari produk berdasarkan ID
        $flashsales = Flashsale::findOrFail($id);

        // Proses upload gambar baru jika ada
        $imageName = $flashsales->image; // Menyimpan gambar lama sebagai default
        if ($request->hasFile('image')) {
            $oldPath = public_path('images/' . $flashsales->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        }

        // Update data produk
        $flashsales->update([
            'name' => $request->name,
            'diskon_price' => $request->diskon_price,
            'original_price' => $request->original_price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
            
        ]);

        // Pengecekan apakah produk berhasil diperbarui
        if ($flashsales) {
            Alert::success('Berhasil!', 'Produk Flashsale berhasil diperbarui!');
            return redirect()->route('admin.flashsale');
        } else {
            Alert::error('Gagal!', 'Produk Flashsale gagal diperbarui!');
            return redirect()->back();
        }
    }
    public function delete($id)
    {
        $flashsales = Flashsale::findOrFail($id);
        if ($flashsales->image) {
            File::delete(public_path('images/' . $flashsales->image));
        }
        $flashsales->delete();

        Alert::success('Berhasil!', 'Produk berhasil dihapus!');
        return redirect()->route('admin.flashsale');
    }

    
} 
    

