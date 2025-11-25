<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $primaryKey = 'idProyek';

    protected $fillable = ['namaProyek', 'tipeRs', 'group', 'namaGroup', 'tglMulai', 'tglAkhir', 'konsepKerjasama', 'alamat'];


    public function mandays() {
        return $this->hasOne(Mandays::class, 'idProyek', 'idProyek');
    }

    public function tikets() {
        return $this->hasMany(Tiket::class, 'idProyek', 'idProyek');
    }

    public function user() {
        return $this->hasMany(User::class, 'idProyek', 'idProyek');
    }
}

