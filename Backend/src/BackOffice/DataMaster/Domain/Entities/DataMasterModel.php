<?php
namespace App\BackOffice\DataMaster\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataMasterModel extends Model
{
    protected $table = "table_master";

    protected $fillable = [];

    use SoftDeletes;

    const UPDATED_AT = null;
}