<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'storage';
    protected $primaryKey = 'IDstorage';
    public $timestamps = false;
    protected $guarded = [];

    // СВЯЗЬ 1: Запись на складе принадлежит конкретному комплектующему
    public function product()
    {
        return $this->belongsTo(ProductsCatalog::class, 'IDpc', 'IDpc');
    }

    // СВЯЗЬ 2: Запись на складе находится в конкретной локации
    public function location()
    {
        return $this->belongsTo(StorageLocation::class, 'lsName', 'lsName');
    }
}
