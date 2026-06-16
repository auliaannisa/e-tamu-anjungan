<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    // Mengizinkan pengisian data kolom relasi dan kata kunci
    protected $fillable = ['department_id', 'keyword_word'];

    // Relasi: Kata kunci ini dimiliki oleh suatu bidang
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}