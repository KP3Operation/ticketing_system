@extends('layouts.app')
@section('title', 'Tambah Tiket')
@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah Tiket</h5>
            </div>
            <form action="{{ route('tiket.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body text-start">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="judul">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="judul" class="form-control" id="judul"
                                placeholder="Masukkan judul" required />
                        </div>
                        @error('judul')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi" required></textarea>
                        </div>
                        @error('deskripsi')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="kategori">Kategori</label>
                        <div class="col-sm-4">
                            <select id="kategori" class="form-select" name="kategori" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach (['Bugs', 'General', 'Question', 'Request Change'] as $kategori)
                                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('kategori')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                        <label class="col-sm-2 col-form-label" for="prioritas">Prioritas</label>
                        <div class="col-sm-4">
                            <select id="prioritas" class="form-select" name="prioritas" required>
                                <option value="" disabled selected>Pilih Prioritas</option>
                                @foreach (['Low', 'Normal', 'High', 'Urgent', 'Immediete'] as $prioritas)
                                    <option value="{{ $prioritas }}">{{ $prioritas }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('prioritas')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="severity">Severity</label>
                        <div class="col-sm-4">
                            <select id="severity" class="form-select" name="severity" required>
                                <option value="" disabled selected>Pilih Severity</option>
                                @foreach (['Minor', 'Mayor'] as $severity)
                                    <option value="{{ $severity }}">{{ $severity }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('severity')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                        <label class="col-sm-2 col-form-label" for="picRs">PIC
                            RS</label>
                        <div class="col-sm-4">
                            <select id="picRs" class="form-select" name="picRs" required>
                                <option value="" disabled selected>Pilih PIC RS</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->userId }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('picRs')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                        <input type="text" hidden value="Request" name="status" />
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="idProyek">Nama
                            Proyek</label>
                        <div class="col-sm-4">
                            <select id="idProyek" class="form-select" name="idProyek" required>
                                <option value="" disabled selected>Pilih Proyek</option>
                                @foreach ($proyeks as $proyek)
                                    <option value="{{ $proyek->idProyek }}">{{ $proyek->namaProyek }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('idProyek')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                        <label class="col-sm-2 col-form-label" for="basic-default-dueDate">Due
                            Date</label>
                        <div class="col-sm-4">
                            <input type="date" name="dueDate" class="form-control" id="basic-default-dueDate" />
                        </div>
                        @error('dueDate')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-tglDikerjakan">Tanggal
                            Dikerjakan</label>
                        <div class="col-sm-4">
                            <input type="date" name="tglDikerjakan" class="form-control"
                                id="basic-default-tglDikerjakan" />
                        </div>
                        @error('tglDikerjakan')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                        <label class="col-sm-2 col-form-label" for="basic-default-tglSelesai">Tanggal
                            Selesai</label>
                        <div class="col-sm-4">
                            <input type="date" name="tglSelesai" class="form-control"
                                id="basic-default-tglSelesai" />
                        </div>
                        @error('tglSelesai')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-persetujuan ">Tag</label>
                        <div class="col-sm-10">
                            <input type="text" name="tag" class="form-control" id="basic-default-tag"
                                placeholder="Masukkan tag" />
                        </div>
                        @error('tag')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-alasan">Alasan
                            Permintaan</label>
                        <div class="col-sm-10">
                            <textarea id="basic-default-alasan" name="alasanPermintaan" class="form-control" placeholder="Masukkan alasan"
                                aria-describedby="basic-icon-default-alasan2" required></textarea>
                        </div>
                        @error('alasanPermintaan')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-dampak">Dampak</label>
                        <div class="col-sm-10">
                            <textarea id="basic-default-dampak" name="dampak" class="form-control" placeholder="Masukkan dampak"
                                aria-describedby="basic-icon-default-dampak2" required></textarea>
                        </div>
                        @error('dampak')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-assignTo">Assign
                            To</label>
                        <div class="col-sm-4">
                            <select id="assignTo" class="form-select" name="assignTo">
                                <option value="" disabled selected>Assign To</option>
                                @foreach ($users->where('statusUser', 1) as $user)
                                    <option value="{{ $user->userId }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('assignTo')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                        <label class="col-sm-2 col-form-label" for="basic-default-plAviat">PL
                            Aviat</label>
                        <div class="col-sm-4">
                            <select id="idProyek" class="form-select" name="plAviat">
                                <option value="" disabled selected>PL Aviat</option>
                                @foreach ($users->where('statusUser', 1) as $user)
                                    <option value="{{ $user->userId }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('plAviat')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-persetujuan ">Persetujuan</label>
                        <div class="col-sm-4">
                            <select name="persetujuan" class="form-select" id="persetujuan">
                                <option value="" disabled selected>Pilih Jenis Persetujuan
                                </option>
                                <option value="1">Disetujui</option>
                                <option value="0">Tidak Disetujui</option>
                            </select>
                        </div>
                        @error('persetujuan')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                        <label class="col-sm-2 col-form-label" for="basic-default-tglPersetujuan">Tanggal
                            Disetujui</label>
                        <div class="col-sm-4">
                            <input type="date" name="tglPersetujuan" class="form-control"
                                id="basic-default-tglPersetujuan" />
                        </div>
                        @error('tglDisetujui')
                            <div class="text text-danger text-start">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="lampiran" class="filepond" multiple
                            credits="false" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-danger me-2" onclick="window.history.back()">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah Tiket</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                process: '{{ route('image.store') }}',
                revert: '{{ route('image.destroy') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            }
        })
    </script>
@endpush
