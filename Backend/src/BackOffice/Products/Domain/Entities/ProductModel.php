<?php
namespace App\BackOffice\Products\Domain\Entities;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\MeasureUnits\Domain\Entities\MeasureUnitModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    protected $table = "product";

    protected $fillable = [
        'id',
        'code',
        'uuid',
        'name',
        'id_category',
        'id_unit_measurent',
        'description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'active'
    ];

    use SoftDeletes;

    protected $with = ['category', 'measureUnit'];


    public function category() {
        return $this->belongsTo(CategoryModel::class, 'id_category', 'id');
    }

    public function measureUnit() {
        return $this->belongsTo(DataMasterModel::class, 'id_unit_measurent', 'id');
    }

    const UPDATED_AT = null;
}