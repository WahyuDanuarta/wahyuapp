@extends('layouts.admin.main')
@section('title', 'Admin Edit Product Flashsale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Produk Flashsale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.flashsale') }}">Produk</a>
                </div>
                <div class="breadcrumb-item">Edit Produk Flashsale</div>
            </div>
        </div>

        </a>

        <div class="card mt-4">
            <form action="{{ route('flashsale.update', $flashsales->id) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nama Produk Flashsale</label>
                                <input id="name" type="text" class="form-control" name="name" required="" value="{{ $flashsales->name }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="diskon_price">Harga Diskon Produk</label>
                                <input id="diskon_price" type="number" class="form-control" name="diskon_price" required="" value="{{ $flashsales->diskon_price }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="original_price">Harga Original Produk</label>
                                <input id="original_price" type="number" class="form-control" name="original_price" required="" value="{{ $flashsales->original_price }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category">Kategori Produk</label>
                                <input id="category" type="text" class="form-control" name="category" required="" value="{{ $flashsales->category }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Deskripsi Produk</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="4" required="">{{ $flashsales->description }}</textarea>
                                <div class="invalid-feedback">
                                    Kolom deskripsi harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="image" id="customFile" type="file">
                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan</button>
                                <a href="{{ route('admin.flashsale') }}" class="btn btn-icon icon-left btn-warning"> Batal</a>
                    
                </div>
            </form>
        </div>
    </section>
</div>
@endsection