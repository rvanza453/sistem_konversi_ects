<?php

namespace App\Models;

use App\Models\User;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// app/Models/Transkrip.php
class Transkrip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'biodata_id',
        'mata_kuliah_id',
        'nilai',
    ];
    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}
