<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flashsale;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FlashsaleController extends Controller
{
    public function index()
    {
        $flashsales = Flashsale::with('product')->get();
        confirmDelete('Hapus Data!', 'Apakah Anda yakin ingin menghapus data ini?');
        return view('pages.admin.flashsale.index', compact('flashsales'));
    }

    public function create()
    {
        // Ambil data produk untuk dropdown
        $products = Product::all();
        return view('pages.admin.flashsale.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_product' => 'required|exists:products,id',
            'diskon_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($request->id_product);
        if ($request->diskon_price >= $product->price) {
            Alert::error('Gagal!', 'Diskon harus lebih kecil dari harga produk!');
            return redirect()->back()->withInput();
        }

        Flashsale::create([
            'id_product' => $request->id_product,
            'diskon_price' => $request->diskon_price,
        ]);

        Alert::success('Berhasil!', 'Flash Sale berhasil ditambahkan!');
        return redirect()->route('admin.flashsale');
    }

    public function edit($id)
    {
        // Ambil data flashsale dan produk untuk form edit
        $flashsale = Flashsale::findOrFail($id);
        $products = Product::all();
        return view('pages.admin.flashsale.edit', compact('flashsale', 'products'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_product' => 'required|exists:products,id',
            'diskon_price' => 'numeric|min:0', // Hapus validasi tidak dikenal
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($request->id_product);
        if ($request->diskon_price >= $product->price) {
            Alert::error('Gagal!', 'Diskon harus lebih kecil dari harga produk!');
            return redirect()->back()->withInput();
        }

        $flashsale = Flashsale::findOrFail($id);

        $flashsale->update([
            'id_product' => $request->id_product,
            'diskon_price' => $request->diskon_price,
        ]);

        Alert::success('Berhasil!', 'Flash Sale berhasil diperbarui!');
        return redirect()->route('admin.flashsale');
    }

    public function delete($id)
    {
        // Cari flashsale berdasarkan ID
        $flashsale = Flashsale::findOrFail($id);

        // Hapus flashsale
        $flashsale->delete();

        Alert::success('Berhasil!', 'Flash Sale berhasil dihapus');
        return redirect()->route('admin.flashsale');
    }
}
