<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Biodata.php
class Biodata extends Model
{
    protected $fillable = ['user_id', 'npm', 'no_hp', 'photo']; // Tambahkan user_id

    public function user()
    {
        // user_id bisa null, jadi relasinya tetap belongsTo
        return $this->belongsTo(User::class);
    }

    public function transkrips()
    {
        return $this->hasMany(Transkrip::class);
    }
}