@extends('layouts.app')
@section('title', 'Informasi Akun')
@section('content')
<h4 class="py-3 mb-4 text-start"><span class="text-muted fw-light">Informasi Akun /</span>
    {{ $users->nama }}</h4>

<div class="row text-start">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    @if ($users->profile && $users->profile->path)
                        <img src="{{ asset('ticketing_system/storage/app/public/profiles/') }}" alt class="rounded-circle" style="width: 100px;" />
                    @else
                        <img src="{{ asset('ticketing_system/storage/app/public/profiles/profile.png') }}" alt class="rounded-circle" style="width: 100px;" />
                    @endif
                </div>
            </div>
            <hr class="my-0" />
            <form action="{{ route('masterUser.update', $users->userId) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Id Karyawan</label>
                            <input class="form-control" name="idKaryawan"
                                value="{{ $users->idKaryawan }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nama</label>
                            <input class="form-control" name="nama"
                                value="{{ $users->nama }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Username</label>
                            <input class="form-control" name="username"
                                value="{{ $users->username }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Email</label>
                            <input class="form-control" name="email"
                                value="{{ $users->email }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nama Proyek</label>
                            <input class="form-control" type="text" name="idProyek" value="{{ $proyeks->firstWhere('idProyek', $users->idProyek)->namaProyek ?? '' }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nama Department</label>
                            <input class="form-control" name="idDepartment" value="{{ $users->idDepartment }}" disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nama Grup User</label>
                            <input type="text" class="form-control" name="role" value="{{ $roles->firstWhere('name', $users->roles->first()->name)->name ?? '' }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Status Akun</label>
                            <input type="text" class="form-control" name="statusUser" value="{{ $users->statusUser == 1 ? 'Aktif' : 'Tidak Aktif' }}" disabled>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-danger me-2"
                                onclick="window.history.back()">Batal</button>
                            <button type="submit" class="btn btn-success">Edit Akun</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
