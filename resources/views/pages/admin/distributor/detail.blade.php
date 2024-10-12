@extends('layouts.admin.main')
@section('title', 'Detail Distributor')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Distributor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.distributor') }}">Distributor</a></div>
                <div class="breadcrumb-item">Detail Distributor</div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Distributor</label>
                    <input type="text" class="form-control" value="{{ $distributor->nama_distributor }}" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" value="{{ $distributor->lokasi }}" readonly>
                </div>
                <div class="form-group">
                    <label>Kontak</label>
                    <input type="text" class="form-control" value="{{ $distributor->kontak }}" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ $distributor->email }}" readonly>
                </div>
                <a href="{{ route('admin.distributor') }}" class="btn btn-icon icon-left btn-warning">Kembali</a>
            </div>
        </div>
    </section>
</div>
@endsection
