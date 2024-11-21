@extends('layouts.admin.main')

@section('title', 'Edit Admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Admin</h1>
        </div>
        <div class="section-body">
            <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">
                        <!-- Field untuk nama -->
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
                        </div>

                        <!-- Field untuk username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
                        </div>

                        <!-- Field untuk email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
                        </div>

                        <!-- Field untuk password -->
                        <div class="form-group">
                            <label for="password">Password (kosongkan jika tidak ingin diubah)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection