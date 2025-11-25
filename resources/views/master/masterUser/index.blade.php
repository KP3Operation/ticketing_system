@extends('layouts.app')
@section('title', 'Master User')
@section('content')
    <div class="container d-flex justify-content-between align-items-center">
        <h4 class="py-3 mb-0">Detail Pengguna</h4>
        @include('master.masterUser.create')
        <a class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addUser" href="#">Tambah Akun</a>
    </div>

    <div class="card mb-3">
        <div class="table-responsive">
            <table class="table table-striped" id="userTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">Nama User</th>
                        <th class="text-white">Username</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Nama Proyek</th>
                        <th class="text-white">Grup User</th>
                        <th class="text-white">Status Pengguna</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($masterUsers as $user)
                        <tr>
                            <td class="text-start">{{ $user->nama }}</td>
                            <td class="text-start">{{ $user->username }}</td>
                            <td class="text-start">{{ $user->email }}</td>
                            <td class="text-start">
                                {{ $user->proyek ? $user->proyek->namaProyek : 'Tidak ada proyek' }}</td>
                            <td class="text-start">
                                @foreach ($user->roles as $grupUser)
                                    {{ $grupUser->name }}
                                @endforeach
                            </td>
                            <td>
                                @if ($user->status === 1)
                                    <span class="badge bg-label-primary me-1">Aktif</span>
                                @else
                                    <span class="badge bg-label-warning me-1">Tidak
                                        Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('masterUser.show', $user->userId) }}"><i
                                                class="bx bx-user me-2"></i>Detail Akun</a>
                                        <form action="{{ route('masterUser.destroy', $user->userId) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="confirm-text" class="dropdown-item"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                <i class="bx bx-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="5" class="text-center">No data to display</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <nav aria-label="..." class="pagination justify-content-end">
        {{ $masterUsers->links() }}
    </nav>
@endsection
@push('scripts')
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach((inputElement) => {
            const pond = FilePond.create(inputElement);
            FilePond.setOptions({
                server: {
                    process: '{{ route('image.store') }}',
                    revert: '{{ route('image.destroy') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                }
            });
        });
    </script>

    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/sl-2.0.4/datatables.min.js">
    </script>
    <script>
        var table = $('#userTable').DataTable({
            layout: {
                topEnd: [
                    'search',
                ],
            },
        })
    </script>
@endpush
