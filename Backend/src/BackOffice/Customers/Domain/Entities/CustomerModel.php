<?php
namespace App\BackOffice\Customers\Domain\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Model
{
    protected $table = "customer";

    protected $fillable = [
        'id',
        'uuid',
        'first_name',
        'last_name',
        'document_number',
        'document_type_id',
        'email',
        'business_name',
        'ruc',
        'home_phone_number',
        'cell_phone_number',
        'address',
        'department_id',
        'province_id',
        'district_id',
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

}