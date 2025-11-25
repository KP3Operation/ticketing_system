<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Proyek;
use App\Models\Mandays;
use App\Models\Lampiran;
use Illuminate\Http\Request;
use App\Models\TemporaryImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTiketRequest;
use Illuminate\Support\Facades\Validator;

class TiketController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->statusUser == 1) {
            $tikets = Tiket::all();
        } else {
            if ($user->idProyek) {
                $tikets = Tiket::where('idProyek', $user->idProyek)->get();
            } else {
                $tikets = collect();
            }
        }
        $proyeks = Proyek::all();

        return view('issue.tiket.index', compact('tikets', 'proyeks'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        $users = User::all();

        return view('issue.tiket.create', compact('proyeks', 'users'));
    }

    public function user_create()
    {
        $proyeks = Proyek::all();
        $users = User::where('idProyek', Auth::user()->idProyek)->get();

        return view('issue.tiket.user.create', compact('proyeks', 'users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idProyek' => 'nullable',
            'judul' => 'nullable',
            'deskripsi' => 'nullable',
            'kategori' => 'nullable',
            'prioritas' => 'nullable',
            'severity' => 'nullable',
            'picRs' => 'nullable',
            'alasanPermintaan' => 'nullable',
            'dampak' => 'nullable',
            'mandays' => 'nullable',
            'label' => 'nullable',
            'assignTo' => 'nullable',
            'plAviat' => 'nullable',
            'persetujuan' => 'nullable',
            'tglPersetujuan' => 'nullable',
            'tag' => 'nullable',
            'tglDikerjakan' => 'nullable',
            'dueDate' => 'nullable',
            'tglSelesai' => 'nullable',
            'status' => 'nullable',
        ]);

        $temporaryFiles = TemporaryImage::all();

        if ($validator->fails()) {
            foreach ($temporaryFiles as $temporaryFile) {
                Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);
                $temporaryFile->delete();
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tiket = Tiket::create($validator->validated());

        foreach ($temporaryFiles as $temporaryFile) {
            $folderPath = 'public/images/' . $temporaryFile->folder;
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
                chmod(Storage::path($folderPath), 0755);
            }
            
            Storage::copy('images/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->file, $folderPath . '/' . $temporaryFile->file);
            Lampiran::create([
                'idTiket' => $tiket->idTiket,
                'name' => $temporaryFile->file,
                'path' => $temporaryFile->folder . '/' . $temporaryFile->file
            ]);
            Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);
            $temporaryFile->delete();
        }

        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil dibuat');
    }

    public function show($idTiket)
    {
        $tikets = Tiket::findOrFail($idTiket);
        $proyeks = Proyek::all();
        $users = User::all();
        $mandays = Mandays::all();

        return view('issue.tiket.edit', compact('tikets', 'proyeks', 'users', 'mandays'));
    }

    public function update(StoreTiketRequest $request, $idTiket)
    {
        $tiket = Tiket::findOrFail($idTiket);
        $tiket->update($request->all());

        return redirect()->back();
    }

    public function destroy($idTiket)
    {
        $tiket = Tiket::find($idTiket);
        if ($tiket) {
            $tiket->lampirans()->delete();
            $tiket->delete();
        }

        return redirect()->back();
    }
}
