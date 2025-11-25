@extends('layouts.app')
@section('title', 'Izin')
@section('content')
    <div class="container d-flex justify-content-between align-items-center">
        @include('master.permission.create')
        <h4 class="py-3 mb-0">Detail Izin</h4>
        <a class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addPermission"
            href="{{ route('permission.store') }}">Tambah Izin</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped text-start" id="permissionTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">Nama Izin</th>
                        <th class="text-white">Guard</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>{{ $permission->deskripsi }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"
                                            data-bs-target="#modal-form-edit-permission-{{ $permission->id }}"
                                            data-bs-toggle="modal"><i class="bx bx-edit-alt me-2"></i>Edit</a>
                                        <form action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                <i class="bx bx-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                    @include('master.permission.edit')
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="5" class="text-center">Tidak ada data untuk
                                ditampilkan</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/sl-2.0.4/datatables.min.js">
    </script>
    <script>
        var table = $('#permissionTable').DataTable({
            layout: {
                topEnd: [
                    'search',
                ],
            },
        })
    </script>
@endpush
