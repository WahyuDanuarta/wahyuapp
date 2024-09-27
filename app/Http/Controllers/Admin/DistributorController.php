<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\distributor;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = distributor::all();

        return view('pages.admin.distributor.index', compact('distributors'));
    }
}
