<?php
namespace App\BackOffice\Providers\Domain\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderModel extends Model
{
    protected $table = "provider";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'department_id',
        'province_id',
        'district_id',
        'ruc',
        'address',
        'home_phone_number',
        'cell_phone_number',
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

//    protected $with = ['person'];
//
//    public function person()
//    {
//        // return $this->belongsTo(UserTypeModel::class, 'user_type_id', 'id');
////        return $this->hasOne(Person::class, 'person_id', 'id');
//    }
}