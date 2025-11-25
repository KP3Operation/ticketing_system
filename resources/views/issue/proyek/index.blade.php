@extends('layouts.app')
@section('title', 'Proyek')
@section('content')
    <div class="container d-flex justify-content-between align-items-center">
        @include('issue.proyek.create')
        <h4 class="py-3 mb-0">Detail Proyek</h4>
        <a class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProyek" href="">Tambah
            Proyek</a>
    </div>
    {{-- End Navbar Tambah Grup User --}}

    <div class="card">
        <div class="table-responsive">
            <table class="table small-font-size table-striped text-start" id="proyekTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">Nama Proyek</th>
                        <th class="text-white">Tipe RS</th>
                        <th class="text-white">Group</th>
                        <th class="text-white">Nama Group</th>
                        <th class="text-white">Tanggal Mulai</th>
                        <th class="text-white">Tanggal Akhir</th>
                        <th class="text-white">Konsep Kerjasama</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-start">
                    @forelse ($proyek as $item)
                        <tr>
                            <td>{{ $item->namaProyek }}</td>
                            <td><span class="badge bg-label-success me-1">Tipe
                                    {{ $item->tipeRs }}</span>
                            </td>
                            <td>
                                @if ($item->group === 1)
                                    <span class="badge bg-label-primary me-1">Group</span>
                                @else
                                    <span class="badge bg-label-primary me-1">Bukan Group</span>
                                @endif
                            </td>
                            <td>{{ $item->namaGroup }}</td>
                            <td>{{ $item->tglMulai }}</td>
                            <td>{{ $item->tglAkhir }}</td>
                            <td><span class="badge bg-label-info me-1">{{ $item->konsepKerjasama }}</span>
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"
                                            data-bs-target="#modal-form-edit-proyek-{{ $item->idProyek }}"
                                            data-bs-toggle="modal"><i class="bx bx-edit-alt me-2"></i>Edit</a>
                                        <form action="{{ route('proyek.destroy', $item->idProyek) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                <i class="bx bx-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                    @include('issue.proyek.edit')
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="9" class="text-center">Tidak ada data untuk
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
        var table = $('#proyekTable').DataTable({
            layout: {
                topEnd: [
                    'search',
                ],
            },
        })
    </script>
@endpush
