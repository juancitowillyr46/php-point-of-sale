<?php
namespace App\BackOffice\Ubigeo\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UbigeoModel extends Model
{
    protected $table = "ubigeo";

    public $timestamps = ["created_at", "updated_at", "deleted_at"];

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'created_at',
        'created_by',
        'deleted_at',
        'deleted_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    use SoftDeletes;

    const UPDATED_AT = null;

}