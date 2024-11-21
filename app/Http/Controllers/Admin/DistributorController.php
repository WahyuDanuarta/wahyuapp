<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DistributorImport;
use Illuminate\Http\Request;
use App\Models\distributor;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class DistributorController extends Controller
{
    public function index()
    {
        $distributors = distributor::all();
        
        confirmDelete('Hapus Data!', 'apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.distributor.index', compact('distributors'));
    }

    public function create()
    {
        return view('pages.admin.distributor.create');
    }

    public function detail($id)
    {
        $distributor = distributor::findOrFail($id);
        return view('pages.admin.distributor.detail', compact('distributor'));
    }

    public function edit($id)
    {
        $distributor = distributor::findOrFail($id);
        return view('pages.admin.distributor.edit', compact('distributor'));
    }

    // Menambahkan data distributor
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_distributor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan distributor
        $distributor = distributor::create([
            'nama_distributor' => $request->nama_distributor,
            'lokasi' => $request->lokasi,
            'kontak' => $request->kontak,
            'email' => $request->email,
        ]);

        // Pengecekan apakah distributor berhasil disimpan
        if ($distributor) {
            Alert::success('Berhasil!', 'Distributor berhasil ditambahkan!');
            return redirect()->route('admin.distributor');
        } else {
            Alert::error('Gagal!', 'Distributor gagal ditambahkan!');
            return redirect()->back();
        }
    }


    // Update data distributor
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_distributor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mencari distributor berdasarkan ID
        $distributor = distributor::findOrFail($id);

        // Update data distributor
        $distributor->update([
            'nama_distributor' => $request->nama_distributor,
            'lokasi' => $request->lokasi,
            'kontak' => $request->kontak,
            'email' => $request->email,
        ]);

        // Pengecekan apakah distributor berhasil diperbarui
        if ($distributor) {
            Alert::success('Berhasil!', 'Distributor berhasil diperbarui!');
            return redirect()->route('admin.distributor');
        } else {
            Alert::error('Gagal!', 'Distributor gagal diperbarui!');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $distributor = distributor::findOrFail($id);
        $distributor->delete();

        if ($distributor) {
            Alert::success('Berhasil!', 'Distributor berhasil dihapus');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Distributor gagal dihapus!');
            return redirect()->back();
        }
    }
        public function import(Request $request)
    {
        try {
            $file = $request->file('file');

            // Pastikan file telah dipilih sebelum mencoba mengimpor
            if (!$file) {
                Alert::error('Gagal!', 'Tidak ada file yang dipilih.');
                return redirect()->back();
            }

            Excel::import(new DistributorImport, $file);
            Alert::success('Berhasil!', 'Data berhasil diimport!');
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $messages = '';

            foreach ($failures as $failure) {
                $messages .= 'Kesalahan pada baris ' . $failure->row() . ': ' . implode(', ', $failure->errors()) . '. ';
            }

            Alert::error('Gagal!', 'Validasi Gagal: ' . $messages);
            
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Pastikan format dan isi sudah benar! Error: ' . $e->getMessage());
            
        } finally {
            return redirect()->back();
        }
    }

    public function export()
{
    try {
        // Ambil semua data distributor
        $distributors = Distributor::all();

        // Muat tampilan dan buat PDF
        $pdf = Pdf::loadView('pages.admin.distributor.export', compact('distributors'))
                  ->setPaper('a4', 'landscape');

        // Unduh PDF dengan nama file yang sesuai
        return $pdf->download('distributor.pdf');

    } catch (\Exception $e) {
        // Tangani kesalahan jika ada
        Alert::error('Gagal!', 'Gagal mengekspor data: ' . $e->getMessage());
        return redirect()->back();
    }
}


}
