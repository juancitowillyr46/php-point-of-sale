<?php
namespace App\BackOffice\Users\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    protected $table = "user";
    protected $fillable = [
        'id',
        'uuid',
        'username',
        'password',
        'email',
        'user_type_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'active'
    ];

    use SoftDeletes;
    public const UPDATED_AT = null;

}