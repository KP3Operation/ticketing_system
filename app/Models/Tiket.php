<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $primaryKey = 'idTiket';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public static function boot()
    {
        Parent::boot();

        static::creating(function ($tiket) {
            $tiket->idTiket = $tiket->generateIdTiket();
        });
        
        static::deleting(function ($tiket) {
            foreach ($tiket->komentars as $komentar) {
                $komentar->images()->delete();
                $komentar->delete();
            }
        });
    }

    public function generateIdTiket()
    {
        $idProyek = $this->idProyek;
        $yearNow = Carbon::now()->year;

        $count = Self::where('idProyek', $idProyek)
            ->whereYear('created_at', $yearNow)
            ->count() + 1;

        return $idProyek . $yearNow . str_pad($count, 3, '0', STR_PAD_LEFT);
    }

    public function mandays()
    {
        return $this->belongsTo(Mandays::class, 'idProyek', 'idProyek');
    }

    public function proyeks()
    {
        return $this->belongsTo(Proyek::class, 'idProyek', 'idProyek');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'idTiket', 'idTiket');
    }

    public function lampirans() {
        return $this->hasMany(Lampiran::class, 'idTiket');
    }
    
    public function picRS() {
        return $this->belongsTo(User::class, 'picRs', 'userId');
    }

    public function assign() {
        return $this->belongsTo(User::class, 'assignTo', 'userId');
    }

    public function PLAviat() {
        return $this->belongsTo(User::class, 'plAviat', 'userId');
    }
}
