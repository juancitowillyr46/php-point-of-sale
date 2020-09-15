<?php
namespace App\BackOffice\Employees\Domain\Entities;

use App\BackOffice\Persons\Domain\Entities\PersonModel;
use App\BackOffice\Users\Domain\Entities\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeModel extends Model
{
    protected $table = "employee";

    protected $fillable = [
        'id',
        'uuid',
        'user_id',
        'person_id',
		'company_id',
		'type_employee',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
		'deleted_at',
		'deleted_by',
        'active'
    ];

    use SoftDeletes;

    const UPDATED_AT = null;

    protected $with = ['person', 'user'];

    public function person()
    {
        return $this->belongsTo(PersonModel::class, 'person_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }


}