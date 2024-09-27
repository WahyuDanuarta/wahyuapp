@extends('layouts.admin.main') 
@section('title', 'Admin Product') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Produk</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Produk</div> 
            </div> 
        </div> 

        <!-- Button Tambah Produk dengan ikon Font Awesome -->
        <a href="#" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a> 

        <div class="card-body"> 
            <div class="table-responsive"> 
                <table class="table table-bordered table-md"> 
                    <thead>
                        <tr> 
                            <th>#</th> 
                            <th>Nama Produk</th> 
                            <th>Harga Produk</th> 
                            <th>Stok</th> 
                            <th>Action</th> 
                        </tr> 
                    </thead>
                    <tbody>
                    @php 
                        $no = 1; // Penomoran otomatis dimulai dari 1
                    @endphp
                    @forelse ($products as $item) 
                        <tr> 
                            <td>{{ $no++ }}</td> <!-- Nomor produk -->
                            <td>{{ $item->name }}</td> 
                            <td>{{ $item->price }} Points</td> 
                            <td>{{ $item->stock }}</td> 
                            <td> 
                                <!-- Aksi dengan badge dan ikon Font Awesome -->
                                <a href="#" class="badge badge-info">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a> 
                                <a href="#" class="badge badge-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a> 
                                <a href="#" class="badge badge-danger">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a> 
                            </td> 
                        </tr> 
                    @empty 
                        <tr>
                            <td colspan="5" class="text-center">Data Produk Kosong</td> 
                        </tr>
                    @endforelse 
                    </tbody>
                </table> 
            </div> 
        </div> 
    </section> 
</div> 
@endsection
