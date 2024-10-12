@extends('layouts.admin.main')
@section('title', 'Admin Product')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Flashsale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Flashsale</div>
            </div>
        </div>
        <a href="{{ route('admin.flashsale.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk Flashsale</a>
        </a>
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Diskon Produk </th>
                        <th>Harga Original Produk</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                    @php $no = 0; @endphp
                    @forelse ($flashsales as $item)
                    <tr>
                        <td>{{ $no += 1}}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->diskon_price }}</td>
                        <td>{{ $item->original_price }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->description }}</td>

                        <td>
                            <a href="{{ route('flashsale.detail', $item->id) }}" class="badge badge-info">Detail</a>
                            <a href="{{ route('flashsale.edit', $item->id) }}" class="badge badge-warning">Edit</a>
                            <a href="{{ route('flashsale.delete', $item->id) }}" class="badge badge-danger"data-confirm-delete="true">Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Data Produk Flashsale Kosong</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </section>
</div>
@endsection