<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestRequest extends Model
{
    // Mengizinkan pengisian data log tamu
    protected $fillable = ['guest_name', 'purpose', 'matched_department_id', 'accuracy_score'];
}