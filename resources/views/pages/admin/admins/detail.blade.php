@extends('layouts.admin.main')

@section('title', 'Detail Admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Admin</a></div>
                <div class="breadcrumb-item">Detail Admin</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ $admin->name }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Username:</strong> {{ $admin->username }}</p>
                <p><strong>Email:</strong> {{ $admin->email }}</p>
                <hr>
                <h5>Detail Akun Admin</h5>
                <ul>
                    <li><strong>Nama:</strong> {{ $admin->name }}</li>
                    <li><strong>Dibuat pada:</strong> {{ $admin->created_at->format('d M Y H:i') }}</li>
                    <li><strong>Terakhir diupdate:</strong> {{ $admin->updated_at->format('d M Y H:i') }}</li>
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection