<?php
namespace App\BackOffice\MeasureUnits\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeasureUnitModel extends Model
{
    protected $table = "unit_measurement";

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    use SoftDeletes;

    const UPDATED_AT = null;
}