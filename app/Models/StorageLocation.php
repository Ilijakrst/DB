<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageLocation extends Model
{
    protected $table = 'storage_location';
    protected $primaryKey = 'lsName'; // У нас строковый первичный ключ
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    // СВЯЗЬ: Локация принадлежит к определенному типу комплектующих
    public function type()
    {
        return $this->belongsTo(TypeProduct::class, 'IDtp', 'IDtp');
    }

    // СВЯЗЬ: В одной локации может храниться много записей о товарах
    public function storages()
    {
        return $this->hasMany(Storage::class, 'lsName', 'lsName');
    }
}