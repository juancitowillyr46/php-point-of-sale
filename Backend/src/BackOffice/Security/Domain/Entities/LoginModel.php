<?php
namespace App\BackOffice\Security\Domain\Entities;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginModel extends Model
{
    protected $table = "user";

    protected $fillable = [
        'username',
        'password',
    ];

    use SoftDeletes;
}