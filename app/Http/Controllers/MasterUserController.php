<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMasterUserRequest;
use App\Http\Requests\UpdateMasterUserRequest;
use App\Models\Profile;
use App\Models\Proyek;
use App\Models\TemporaryImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class MasterUserController extends Controller
{
    public function index(Request $request)
    {
        $masterUsers = User::query()
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orwhere('email', 'LIKE', '%' . $request->search . '%');
            })
            ->with('roles', function ($query) {
                return $query->select('name');
            })
            ->latest()
            ->paginate(50);

        $roles = Role::orderBy('name')->get();
        $proyeks = Proyek::all();

        return view('master.masterUser.index', compact('masterUsers', 'roles', 'proyeks'));
    }

    public function show($userId)
    {
        $users = User::where('userId', $userId)->firstOrFail();
        $proyeks = Proyek::all();
        $roles = Role::orderBy('name')->get();

        return view('master.masterUser.detail', compact('users', 'proyeks', 'roles'));
    }

    public function store(StoreMasterUserRequest $request, User $user)
    {
        $temporaryFiles = TemporaryImage::all();
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            foreach ($temporaryFiles as $temporaryFile) {
                Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);
                $temporaryFile->delete();
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create(array_merge(
            $validator->validated(),
            array(
                'password' => Hash::make($request->password),
            )
        ))?->assignRole(!blank($request->role) ? $request->role : array());

        if ($user) {
            foreach($temporaryFiles as $temporaryFile) {
                $folderPath = 'public/profiles/' . $temporaryFile->folder;
                if (!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                    chmod(Storage::path($folderPath), 0755);
                }
                
                Storage::copy('images/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->file, $folderPath . '/' . $temporaryFile->file);
                Profile::create([
                    'userId' => $user->userId,
                    'name' => $temporaryFile->file,
                    'path' => 'profiles/' . $temporaryFile->folder . '/' . $temporaryFile->file
                ]);
                Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);
                $temporaryFile->delete();
            }

            return back()->with('success', 'User berhasil');
        } else {
            foreach ($temporaryFiles as $temporaryFile) {
                Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);
                $temporaryFile->delete();
            }
            
            return back()->with('failed', 'User gagal');
        }
    }

    public function update(UpdateMasterUserRequest $request, $userId)
    {
        try {
            $user = User::find($userId);
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'username' => $request->username,
                'idProyek' => $request->idProyek,
                'idKaryawan' => $request->idKaryawan,
                'role' => $request->role,
                'idDepartment' => $request->idDepartment,
                'image' => $request->image,
            ]);

            return User::find($userId)
            ?->syncRoles(!blank($request->role) ? $request->role : array())
            ? back()->with('success', 'User has been updated successfully')
            : back()->with('failed', 'User was not updated successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->profile()->delete();
            $user->delete();
        }

        return redirect()->back();
    }
}
