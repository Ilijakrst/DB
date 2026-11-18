<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectItems extends Model
{
    protected $table = 'project_items';
    protected $primaryKey = 'IDitem';
    public $timestamps = false;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(ProductsCatalog::class, 'IDpc', 'IDpc');
    }
}