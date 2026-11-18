<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    // Имя таблицы в БД
    protected $table = 'projects';

    // Первичный ключ
    protected $primaryKey = 'IDproject';

    // Отключаем created_at и updated_at
    public $timestamps = false;

    // Разрешаем массовое заполнение для всех полей
    protected $guarded = [];

    /**
     * Связь: у проекта есть много комплектующих (спецификация)
     */
    public function items()
    {
        return $this->hasMany(ProjectItems::class, 'IDproject', 'IDproject');
    }
}