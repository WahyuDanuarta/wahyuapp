@extends('layouts.admin.main')
@section('title', 'Edit Distributor')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Distributor</h1>
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

        <form action="{{ route('admin.distributor.update', $distributor->id) }}" method="POST">
            @csrf
            @method('PATCH') <!-- Menambahkan metode PATCH untuk mengupdate -->
            <div class="form-group">
                <label for="nama_distributor">Nama Distributor</label>
                <input type="text" name="nama_distributor" class="form-control" value="{{ old('nama_distributor', $distributor->nama_distributor) }}" required>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $distributor->lokasi) }}" required>
            </div>
            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $distributor->kontak) }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $distributor->email) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.distributor') }}" class="btn btn-icon icon-left btn-warning">Batal</a>
        </form>
    </section>
</div>
@endsection
