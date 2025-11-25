@extends('layouts.app')
@section('title', 'Detail Tiket')
@section('content')
    <div class="card mb-4 text-start">
        <div class="card-header">
            <h5 class="mb-0">Detail Tiket {{ $tikets->idTiket }}</h5>
        </div>
        <div class="card-body">
            @php
                $readonly = auth()->user()->statusUser == 0 ? 'readonly' : '';
                $disabled = auth()->user()->statusUser == 0 ? 'disabled' : '';
            @endphp
            <form action="{{ route('tiket.update', $tikets->idTiket) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-judul">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" class="form-control" id="basic-default-judul"
                            placeholder="Masukkan judul" value="{{ old('judul', $tikets->judul) }}" {{ $readonly }} />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-deskripsi">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea id="basic-default-deskripsi" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi"
                            {{ $readonly }}>{{ $tikets->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-kategori">Kategori</label>
                    <div class="col-sm-4">
                        <select id="basic-default-kategori" class="form-select" name="kategori" {{ $disabled }}>
                            <option value="">Pilih Kategori</option>
                            @foreach (['Bugs', 'General', 'Question', 'Request Change'] as $kategori)
                                <option value="{{ $kategori }}"
                                    {{ old('kategori', $tikets->kategori) == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-prioritas">Prioritas</label>
                    <div class="col-sm-4">
                        <select name="prioritas" id="basic-default-prioritas" class="form-select" {{ $disabled }}>
                            <option value="">Pilih Prioritas</option>
                            @foreach (['Low', 'Normal', 'High', 'Urgent', 'Immediete'] as $item)
                                <option value="{{ $item }}"
                                    {{ old('prioritas', $tikets->prioritas) == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-severity">Severity</label>
                    <div class="col-sm-4">
                        <select name="severity" id="basic-default-severity" class="form-select" {{ $disabled }}>
                            @foreach (['Minor', 'Mayor'] as $item)
                                <option value="{{ $item }}"
                                    {{ old('severity', $tikets->severity == $item ? 'selected' : '') }}>
                                    {{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-status ">Status</label>
                    <div class="col-sm-4">
                        <select name="status" id="basic-default-status" class="form-select" {{ $disabled }}>
                            @foreach (['Request', 'On Progress', 'Discuss', 'Done', 'Closed', 'Reject'] as $item)
                                <option value="{{ $item }}"
                                    {{ old('status', $tikets->status) == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-idProyek">Nama
                        Proyek</label>
                    <div class="col-sm-4">
                        <select id="idProyek" class="form-select" name="idProyek" {{ $disabled }}>
                            @foreach ($proyeks as $proyek)
                                <option disabled value="{{ $proyek->idProyek }}"
                                    {{ $tikets->idProyek == $proyek->idProyek ? 'selected' : '' }}>
                                    {{ $proyek->namaProyek }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-deskripsi">PIC
                        RS</label>
                    <div class="col-sm-4">
                        <select id="picRs" class="form-select" name="picRs" {{ $disabled }}>
                            @foreach ($users as $user)
                                <option value="{{ $user->userId }}"
                                    {{ $tikets->picRs == $user->userId ? 'selected' : '' }}>
                                    {{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-tglKirim">Tanggal
                        Kirim</label>
                    <div class="col-sm-4">
                        <input type="text" readonly name="created_at" class="form-control" id="basic-default-tglKirim"
                            value="{{ old('created_at', $tikets->created_at)->isoFormat('DD MMM YYYY') }}" />
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-dueDate">Due
                        Date</label>
                    <div class="col-sm-4">
                        <input type="date" name="dueDate" class="form-control" id="basic-default-dueDate"
                            value="{{ old('dueDate', $tikets->dueDate)}}"
                            {{ $readonly }} />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-tglDikerjakan">Tanggal
                        Dikerjakan</label>
                    <div class="col-sm-4">
                        <input type="date" name="tglDikerjakan" class="form-control" id="basic-default-tglDikerjakan"
                            value="{{ old('tglDikerjakan', $tikets->tglDikerjakan) }}" {{ $readonly }} />
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-tglSelesai">Tanggal
                        Selesai</label>
                    <div class="col-sm-4">
                        <input type="date" name="tglSelesai" class="form-control" id="basic-default-tglSelesai"
                            value="{{ old('tglSelesai', $tikets->tglSelesai) }}" {{ $readonly }} />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-alasan">Alasan
                        Permintaan</label>
                    <div class="col-sm-10">
                        <textarea id="basic-default-alasan" name="alasanPermintaan" class="form-control"
                            placeholder="Masukkan alasan permintaan" {{ $readonly }}>{{ $tikets->alasanPermintaan }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-dampak">Dampak</label>
                    <div class="col-sm-10">
                        <textarea id="basic-default-dampak" name="dampak" class="form-control" placeholder="Masukkan dampak"
                            {{ $readonly }}>{{ $tikets->dampak }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-assignTo">Assign
                        To</label>
                    <div class="col-sm-4">
                        <select id="picRs" class="form-select" name="assignTo" {{ $disabled }}>
                            @foreach ($users as $user)
                                <option value="{{ $user->userId }}"
                                    {{ $tikets->assignTo == $user->userId ? 'selected' : '' }}>
                                    {{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-plAviat">PL
                        Aviat</label>
                    <div class="col-sm-4">
                        <select id="plAviat" class="form-select" name="plAviat" {{ $disabled }}>
                            @foreach ($users as $user)
                                <option value="{{ $user->userId }}"
                                    {{ $tikets->plAviat == $user->userId ? 'selected' : '' }}>
                                    {{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-persetujuan ">Persetujuan</label>
                    <div class="col-sm-4">
                        <select name="persetujuan" class="form-select" id="persetujuan" {{ $disabled }}>
                            <option value="1" {{ $tikets->persetujuan == 1 ? 'selected' : '' }}>Disetujui</option>
                            <option value="0" {{ $tikets->persetujuan == 0 ? 'selected' : '' }}>Tidak Disetujui
                            </option>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-tglPersetujuan">Tanggal Disetujui</label>
                    <div class="col-sm-4">
                        <input type="date" name="tglPersetujuan" class="form-control"
                            id="basic-default-tglPersetujuan"
                            value="{{ old('tglPersetujuan', $tikets->tglPersetujuan ? \Carbon\Carbon::parse($tikets->tglPersetujuan)->format('Y-m-d') : '') }}"
                            {{ $readonly }} />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-persetujuan ">Tag</label>
                    <div class="col-sm-4">
                        <input type="text" name="tag" class="form-control" id="basic-default-tag"
                            placeholder="Masukkan tag" value="{{ old('tag', $tikets->tag) }}" {{ $readonly }} />
                    </div>
                    <label class="col-sm-2 col-form-label" for="basic-default-tglPersetujuan">Mandays</label>
                    <div class="col-sm-4">
                        <input type="number" name="mandays" class="form-control" placeholder="Masukkan mandays"
                            value="{{ old('mandays', $tikets->mandays) }}" {{ $readonly }}>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="lampiran">Lampiran</label>
                    <div class="col-sm-10">
                        @forelse ($tikets->lampirans as $image)
                            @php
                                $filename = basename($image->path);
                                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                                <img style="width: 30%; height: auto;"
                                    src="{{ asset('ticketing_system/storage/app/public/images/' . $image->path) }}"><br>
                            @else
                                <a href="{{ asset('ticketing_system/storage/app/public/images/' . $image->path) }}" target="blank">{{ $filename }}</a><br>
                            @endif
                        @empty
                            <input type="file" name="lampiran" id="lampiran" class="filepond"
                                {{ $readonly }} />
                        @endforelse

                    </div>
                </div>
                @if (auth()->user()->statusUser == 1)
                    <div class="row">
                        <div class="col-sm-10">
                            <a type="button" href="javascript:history.back()" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success">Edit Tiket</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <div class="text-start">
        @include('issue.komentar.index')
    </div>
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
@endpush
