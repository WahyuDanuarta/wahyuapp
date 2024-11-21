@extends('layouts.admin.main')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Admin</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mb-4">
                    <div class="col">
                        <a href="{{ route('admin.create') }}" class="btn btn-primary">Tambah Admin Baru</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Admin</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->username }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.detail', $admin->id) }}" class="btn btn-info">Detail</a>
                                                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                                                    <button class="btn btn-danger" onclick="deleteAdmin({{ $admin->id }})">Hapus</button>
                                                    
                                                    <!-- Form Hapus -->
                                                    <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert untuk Hapus -->
    <script>
        function deleteAdmin(id) {
            Swal.fire({
                title: 'Hapus Admin!',
                text: "Apakah Anda yakin ingin menghapus admin ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak, batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <!-- SweetAlert untuk Flash Message -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                showConfirmButton: true
            });
        </script>
    @endif
@endsection