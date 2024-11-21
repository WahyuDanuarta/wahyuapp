@extends('layouts.admin.main')

@section('title', 'Admin Flash Sale')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Flash Sale</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.flashsale.create') }}" class="btn btn-icon icon-left btn-primary">
                    <i class="fas fa-plus"></i> Tambah Produk Flashsale
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga Diskon</th>
                                <th>Harga Original</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @forelse ($flashsales as $item)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->diskon_price }} Points</td>
                                    <td>{{ $item->product->price }} Points</td>
                                    <td>{{ $item->product->category ?? 'Tidak Ada Kategori' }}</td>
                                    <td>{{ $item->product->description }}</td>
                                    <td>
                                        <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="100" height="100">
                                    </td>
                                    <td>
                                        <a href="{{ route('flashsale.edit', $item->id) }}" class="btn btn-icon icon-left btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('flashsale.delete', $item->id) }}" class="btn btn-icon icon-left btn-danger" data-confirm-delete="true">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data Produk Flashsale Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
