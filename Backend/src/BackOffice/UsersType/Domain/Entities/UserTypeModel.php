<?php
namespace App\BackOffice\UsersType\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypeModel extends Model
{
    protected $table = "user_type";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'created_at',
        'created_by',
        'active'
    ];

    use SoftDeletes;
}