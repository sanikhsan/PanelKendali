<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "supplier";
    protected $fillable = [
        'nama_supplier',
        'keterangan'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }
}
