<?php

namespace App\Models;

use App\Models\User;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transkrip extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mata_kuliah_id', 'nilai'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}
