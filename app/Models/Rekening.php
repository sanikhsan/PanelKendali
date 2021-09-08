<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "rekening";
    protected $fillable = [
        'nama_bank',
        'atas_nama',
        'nomor_rekening'
    ];
}
