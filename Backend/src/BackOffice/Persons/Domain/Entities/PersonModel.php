<?php
namespace App\BackOffice\Persons\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonModel extends Model
{
    protected $table = "person";

    protected $fillable = [
        'id',
        'uuid',
        'first_name',
        'last_name',
		'email',
		'home_phone_number',
		'cell_phone_number',
        'document_num',
        'document_type',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    use SoftDeletes;

    const UPDATED_AT = null;

}