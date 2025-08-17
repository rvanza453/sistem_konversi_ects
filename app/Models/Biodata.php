<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'npm',
        'no_hp',
        'photo',
    ];

    /**
     * Mendapatkan user yang memiliki biodata ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}