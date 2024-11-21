<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\distributor;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\select;

class ProductController extends Controller
{
    public function index()
    {
        $data = DB::table('distributors')
            ->join('products', 'distributors.id', '=', 'products.id_distributor')
            ->select('distributors.*', 'products.*')
            ->get();
        confirmDelete('Hapus Data!', 'Apakag anda yakin ingin menghapus data ini?');

        return view('pages.admin.product.index', compact('data'));
    }

    public function create()
    {
        $distributor = distributor::all();
        return view('pages.admin.product.create', compact('distributor'));
    }

    public function detail($id)
    {
        $data = DB::table('distributors')
                ->join('products', 'distributors.id', '=', 'products.id_distributor')
                ->select('products.*', 'distributors.*')
                ->where('products.id', '=', $id)
                ->first();

        return view('pages.admin.product.detail', compact('data'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $distributor = distributor::all();

        return view('pages.admin.product.edit', compact('product', 'distributor'));
    }

    //Menambahkan data product
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_distributor' => 'required|numeric',
            'name' => 'required',
            'price' => 'numeric',
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
        $product = Product::create([
            'id_distributor' => $request->id_distributor,
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // Pengecekan apakah produk berhasil disimpan
        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
            return redirect()->route('admin.product');
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
            'id_distributor' => 'required|numeric',
            'name' => 'required',
            'price' => 'numeric',
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
        $product = Product::findOrFail($id);

        // Proses upload gambar baru jika ada
        $imageName = $product->image; // Menyimpan gambar lama sebagai default
        if ($request->hasFile('image')) {
            $oldPath = public_path('images/' . $product->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        }

        // Update data produk
        $product->update([
            'id_distributor' => $request->id_distributor,
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // Pengecekan apakah produk berhasil diperbarui
        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil diperbarui!');
            return redirect()->route('admin.product');
        } else {
            Alert::error('Gagal!', 'Produk gagal diperbarui!');
            return redirect()->back();
        }
        
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $oldPath = public_path('images/' . $product->image);
        if (File::exists($oldPath)){
            File::delete($oldPath);
        }
        $product->delete();

        if ($product){
            Alert::success('Berhasil!','Produk berhasil dihapus');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Produk gagal diHapus!');
            return redirect()->back();
        }
    }

}