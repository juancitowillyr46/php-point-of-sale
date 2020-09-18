<?php
namespace App\BackOffice\Users\Domain\Entities;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    const UPDATED_AT = null;

    public $timestamps = ["created_at"];

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
//        'updated_at',
        'updated_by',
        'active'
    ];

    protected $with = ['userType'];

    use SoftDeletes;



    public function userType()
    {
        // return $this->belongsTo(UserTypeModel::class, 'user_type_id', 'id');
        return $this->belongsTo(DataMasterModel::class, 'user_type_id', 'id_register');
    }
}