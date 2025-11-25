<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'idKomentar';
    
    protected static function boot() {
        Parent::boot();

        static::deleting(function($komentar) {
            $komentar->images()->delete();
        });
    }

    public function users() {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }

    public function tikets() {
        return $this->belongsTo(Tiket::class, 'idTiket', 'idTiket');
    }

    public function images() {
        return $this->hasMany(Image::class, 'idKomentar');
    }
}
