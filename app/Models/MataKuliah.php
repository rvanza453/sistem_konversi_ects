<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mk', 'kode_mk', 'bobot_sks', 'sks_kuliah', 'sks_seminar', 'sks_praktek'
    ];

    /**
     * Accessor untuk menghitung total bobot ECTS per mata kuliah.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function totalEcts(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $ects_kuliah = $attributes['sks_kuliah'] * 1.07;
                $ects_seminar = $attributes['sks_seminar'] * 1.0;
                $ects_praktek = $attributes['sks_praktek'] * 1.65;

                return round($ects_kuliah + $ects_seminar + $ects_praktek, 2);
            }
        );
    }
}
