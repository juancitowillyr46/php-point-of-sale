<?php
namespace App\BackOffice\Roles\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModel extends Model
{
    protected $table = "role";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    protected $with = ['permissions'];

    use SoftDeletes;

    const UPDATED_AT = null;

    public function permissions()
    {
        return $this->belongsToMany(PermissionModel::class, 'role_permission', 'role_id', 'permission_id');
    }
}