<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Flashsale;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $flashsales = Flashsale::all();

        return view('pages.user.index', compact('flashsales','products'));
    }

    public function detail_flashsale($id)
    {
        $flashsales = Flashsale::findOrFail($id);
        return view('pages.user.detailFlash', compact('flashsales'));
    }

    public function detail_product($id)
{
    $product = Product::findOrFail($id);
    return view('pages.user.detail', compact('product'));
}

public function purchase($productId, $userId)
{
    $product = Product::findOrFail($productId);
    $user = User::findOrFail($userId);

    $currentTime = Carbon::now()->setTimezone('Asia/Jakarta');
    $flashSaleStart = Carbon::createFromTimeString('12:00:00', 'Asia/Jakarta');
    $flashSaleEnd = Carbon::createFromTimeString('23:00:00', 'Asia/Jakarta');

    if ($currentTime->between($flashSaleStart, $flashSaleEnd)) {
        $discountedPrice = $product->price * 0.8; // diskon 20%
    } else {
        $discountedPrice = $product->price;
    }

    if ($user->point >= $discountedPrice) {
        $totalPoints = $user->point - $discountedPrice;

        $user->update([
            'point' => $totalPoints,
        ]);

        History::create([
            'id_user' => $userId,
            'id_product' => $productId,
            'total_harga' => $discountedPrice,
        ]);

        Alert::success('Berhasil!', 'Produk berhasil dibeli dengan harga ' . $discountedPrice);
        return redirect()->back();
    } else {
        Alert::error('Gagal!', 'Point anda tidak cukup!');
        return redirect()->back();
    }
}


    public function purchaseCash($flashId, $userId)
    {
        $flashsale = Flashsale::findOrFail($flashId);
        $user = User::findOrFail($userId);

        if ($user->point >= $flashsale->diskon_price) {
            $totalPoints = $user->point - $flashsale->diskon_price;

            $user->update([
                'point' => $totalPoints,
            ]);

            Alert::success('Berhasil!', 'Produk berhasil dibeli!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Point anda tidak cukup!');
            return redirect()->back();
        }
    }
    public function history($id)
    {
        $data = DB::table('histories')
            ->join('products', 'products.id', '=', 'histories.id_product') // Perbaiki parameter join
            ->where('histories.id_user', '=', $id) // Perbaiki parameter where
            ->get();

        return view('pages.user.history', compact('data'));
    }
}

