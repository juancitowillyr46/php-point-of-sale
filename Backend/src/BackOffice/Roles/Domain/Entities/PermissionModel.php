<?php


namespace App\BackOffice\Roles\Domain\Entities;


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

//    protected $with = ['roles'];

    use SoftDeletes;

    const UPDATED_AT = null;

//    public function roles()
//    {
//        return $this->belongsToMany(RoleModel::class);
//    }
}