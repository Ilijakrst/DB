<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsCatalog extends Model
{
    protected $table = 'products_catalog';
    protected $primaryKey = 'IDpc';
    public $timestamps = false;
    protected $guarded = [];

    // Связь: Комплектующее принадлежит к категории (типу)
    public function type()
    {
        return $this->belongsTo(TypeProduct::class, 'IDtp', 'IDtp');
    }

    // Связь: У комплектующего есть запись на складе
    public function storage()
    {
        return $this->hasOne(Storage::class, 'IDpc', 'IDpc');
    }
}
