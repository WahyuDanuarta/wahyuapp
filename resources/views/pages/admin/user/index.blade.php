@extends('layouts.admin.main')
@section('title', 'Admin User')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Pengguna</div>
            </div>
        </div>
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Poin</th>
                    </tr>
                    @php $no = 0; @endphp
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $no += 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->point }} Points</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Data Pengguna Kosong</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
