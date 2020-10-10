<?php
namespace App\BackOffice\DataMaster\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataMasterModel extends Model
{
    const UPDATED_AT = null;

    protected $table = "table_master";

    public $timestamps = ["created_at", "updated_at", "deleted_at"];

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
        'deleted_at',
        'deleted_by',
        'active'
    ];

    use SoftDeletes;

}