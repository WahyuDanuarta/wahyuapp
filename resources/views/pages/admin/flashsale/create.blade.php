@extends('layouts.admin.main')
@section('title', 'Admin Tambah Flashsale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Flashsale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.flashsale') }}">Flashsale</a></div>
                <div class="breadcrumb-item">Tambah Flashsale</div>
            </div>
        </div>
        <a href="{{ route('admin.flashsale') }}" class="btn btn-icon icon-left btn-warning">Kembali</a>
        <div class="card mt-4">
            <form action="{{ route('flashsale.store') }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                    <!-- Dropdown untuk memilih produk -->
                    <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="id_product">Nama Produk</label>
                                <select name="id_product" class="form-control">
                                        @foreach ($products as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="diskon_price">Harga Diskon (Point)</label>
                            <input id="diskon_price" type="number" class="form-control" name="diskon_price" required="">
                            <div class="invalid-feedback">
                                Kolom ini harus di isi!
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-icon icon-left btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </form>
    </div>
</section>
</div>
@endsection