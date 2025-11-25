<form action="{{ route('komentar.store') }}" method="POST" class="m-4" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="userId" value="{{ Auth::id() }}">
    <input type="hidden" name="idTiket" value="{{ $tikets->idTiket }}">
    <div class="mb-4">
        <label for="komentar" class="form-label">Komentar</label>
        <textarea name="komentar" id="komentar" class="form-control"></textarea>
    </div>
    <div class="form-group mb-4">
        <label class="form-label" for="lampiran">Lampiran</label>
        <input type="file" class="filepond" name="image" multiple credits="false" />
    </div>

    <button type="submit" class="btn btn-success btn-sm">Tambah Komentar</button>
</form>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="container d-flex justify-content-between align-items-center">
                <h4 class="mt-4 mb-0 text-center">Aktivitas</h4>
            </div>
            <div class="mt-4 p-4">
                @forelse ($tikets->komentars()->get() as $komentar)
                    <div class="card mb-3 bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="d-flex">
                                        <h5 class="card-title me-2">{{ $komentar->users->nama }}</h5>
                                        <small
                                            class="text-muted">{{ $komentar->created_at->format('Y-m-d | H:i:s') }}</small>
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <span class="badge bg-info">
                                            @foreach ($komentar->users->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </span>
                                        <span class="badge bg-label-secondary">{{ $komentar->idKomentar }}</span>
                                    </h6>
                                </div>
                                <div>
                                    <form action="{{ route('komentar.destroy', $komentar->idKomentar) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger">
                                            <i class='bx bx-trash-alt'></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="card-text">{{ $komentar->komentar }}</p>
                            @foreach ($komentar->images as $image)
                                @php
                                    $filename = basename($image->path);
                                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <img style="width: 40%; height: auto;" class="mb-3"
                                    src="{{ asset('ticketing_system/storage/app/public/images/' . $image->path) }}" alt="Image"><br>
                                @else
                                    <a
                                        href="{{ asset('ticketing_system/storage/app/public/images/' . $image->path) }}">{{ $filename }}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-center fw-bold">Tidak ada data untuk ditampilkan</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
