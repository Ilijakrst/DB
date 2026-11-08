<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    // ⚠️ Указываем имя таблицы как в БД
    protected $table = 'storage';
    
    // ⚠️ Указываем первичный ключ как в БД
    protected $primaryKey = 'IDstorage';

    protected $guarded = [];

    // ⚠️ ВОТ ЭТА СТРОКА — отключает created_at/updated_at
    public $timestamps = false;
}
