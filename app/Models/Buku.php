<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $fillable = ['judul', 'pengarang', 'kategori'];

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Scope: Hanya buku yang belum dikembalikan
    public function scopeTersedia($query)
    {
        return $query->whereDoesntHave('peminjaman', function ($q) {
            $q->whereNull('tanggal_kembali');
        });
    }
}