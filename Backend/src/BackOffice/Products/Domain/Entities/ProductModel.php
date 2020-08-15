<?php
namespace App\BackOffice\Products\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    protected $table = "product";

    protected $fillable = [
        'id',
        'code',
        'uuid',
        'name',
        'id_category',
        'id_unit_measurent',
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