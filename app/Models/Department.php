<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Mengizinkan pengisian data kolom name dan code
    protected $fillable = ['name', 'code'];

    // Relasi: Satu bidang memiliki banyak kata kunci
    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }
}