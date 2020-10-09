<?php


namespace App\BackOffice\Permissions\Domain\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModel extends Model
{
    protected $table = "permission";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'slug',
        'icon',
        'parent_id',
        'is_parent',
        'is_children',
        'order',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

//    protected $with = ['Permissions'];

    use SoftDeletes;

    const UPDATED_AT = null;

//    public function Permissions()
//    {
//        return $this->belongsToMany(PermissionModel::class);
//    }
}