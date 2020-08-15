<?php
namespace App\BackOffice\Categories\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    protected $table = "category";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    use SoftDeletes;

    const UPDATED_AT = null;
}