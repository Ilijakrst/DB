<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    // Имя таблицы в базе данных
    protected $table = 'type_product';
    
    // Первичный ключ (у тебя он называется IDtp, а не id)
    protected $primaryKey = 'IDtp';

    // Отключаем стандартные поля created_at и updated_at
    public $timestamps = false;

    // Разрешаем массовое заполнение для всех полей
    protected $guarded = [];

    // Связь: у одного типа может быть много комплектующих
    public function products()
    {
        return $this->hasMany(ProductsCatalog::class, 'IDtp', 'IDtp');
    }

    // Связь: один тип может храниться в разных локациях
    public function storageLocations()
    {
        return $this->hasMany(StorageLocation::class, 'IDtp', 'IDtp');
    }
}