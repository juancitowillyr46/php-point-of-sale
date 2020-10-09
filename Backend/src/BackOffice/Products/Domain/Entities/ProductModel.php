<?php
namespace App\BackOffice\Products\Domain\Entities;

use App\BackOffice\Categories\Domain\Entities\CategoryModel;
use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\BackOffice\MeasureUnits\Domain\Entities\MeasureUnitModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
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
        'category_id',
        'unit_measurent_id',
        'provider_id',
        'description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'active'
    ];

    use SoftDeletes;

    protected $with = ['category', 'measureUnit', 'provider'];


    public function category() {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }

    public function measureUnit() {
        return $this->belongsTo(DataMasterModel::class, 'unit_measurent_id', 'id');
    }

    public function provider() {
        return $this->belongsTo(ProviderModel::class, 'provider_id', 'id');
    }

    const UPDATED_AT = null;
}