<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EkoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        $projectManager = Role::firstOrCreate(['name' => 'Eko Test Dev']);
        $projectManager->givePermissionTo(Permission::all());

        User::factory()->create([
            'nama' => 'Dev Test Eko',
            'email' => 'eko@aviat.co.id',
            'username' => 'eko',
            'password' => Hash::make('password2829'),
            'statusUser' => true,
        ])->assignRole('Eko Test Dev');
    }
}
