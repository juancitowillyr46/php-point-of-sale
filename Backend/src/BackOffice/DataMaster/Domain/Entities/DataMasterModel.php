<?php
namespace App\BackOffice\DataMaster\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataMasterModel extends Model
{
    protected $table = "table_master";

    protected $fillable = [
        'id',
        'uuid',
        'id_register',
        'type',
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