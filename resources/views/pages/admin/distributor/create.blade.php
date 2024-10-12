@extends('layouts.admin.main')
@section('title', 'Tambah Distributor')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Distributor</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.distributor.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_distributor">Nama Distributor</label>
                <input type="text" name="nama_distributor" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" name="kontak" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
                <button type="submit" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i>Tambah</button>
            <a href="{{ route('admin.distributor') }}" class="btn btn-icon icon-left btn-warning">Batal</a>
        </form>
    </section>
</div>
@endsection
