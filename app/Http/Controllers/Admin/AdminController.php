<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\distributor;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Flashsale;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::count();
        $users = User::count();
        $distributors = distributor::count();
        $flashsales = Flashsale::count();

        return view('pages.admin.index', compact('products', 'distributors', 'flashsales', 'users',));
    }
}
