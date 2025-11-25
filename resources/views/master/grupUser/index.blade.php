@extends('layouts.app')
@section('title', 'Grup User')
@section('content')
    <div class="container d-flex justify-content-between align-items-center">
        @include('master.grupUser.create')
        <h4 class="py-3 mb-0">Detail Grup User</h4>
        <a class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addGrupUser"
            href="{{ route('grup-user.store') }}">Tambah
            Grup User</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped" id="grupTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white col-2">Grup User</th>
                        <th class="text-white">Akses Menu</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupUsers as $grupUser)
                        <tr class="text-start">
                            <td>{{ $grupUser->name }}</td>
                            <td>
                                @foreach ($grupUser->permissions as $permission)
                                    {{ $permission->name }},
                                @endforeach
                            </td>
                            <td>{{ $grupUser->deskripsi }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#modal-form-edit-role-{{ $grupUser->id }}"><i
                                                class="bx bx-edit-alt me-2"></i>Edit</a>
                                        <form action="{{ route('grup-user.destroy', $grupUser->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                <i class="bx bx-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                    @include('master.grupUser.edit')
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
        var table = $('#grupTable').DataTable({
            layout: {
                topEnd: [
                    'search',
                ],
            },
        })
    </script>
@endpush
