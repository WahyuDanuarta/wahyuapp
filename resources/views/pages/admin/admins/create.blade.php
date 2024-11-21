@extends('layouts.admin.main')

@section('title', 'Tambah Admin Baru')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Admin Baru</h1>
        </div>
        <div class="section-body">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                
                <!-- Field untuk nama -->
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <!-- Field untuk username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <!-- Field untuk email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Field untuk password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
</div>
@endsection