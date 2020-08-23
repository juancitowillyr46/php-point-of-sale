<?php
namespace App\BackOffice\Users\Domain\Entities;

use App\BackOffice\UsersType\Domain\Entities\UserTypeModel;
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
        'active'
    ];

    protected $with = ['userType'];

    use SoftDeletes;

    public function userType()
    {
        return $this->belongsTo(UserTypeModel::class, 'user_type_id', 'id');
    }
}