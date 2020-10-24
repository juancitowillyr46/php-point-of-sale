<?php
namespace App\BackOffice\Sales\Domain\Entities;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
//use App\BackOffice\PurchasesDetail\Domain\Entities\SaleDetailModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleModel extends Model
{
    protected $table = "sale";

    protected $fillable = [
        'id',
        'uuid',
        'document_type_id',
        'document_number',
        'customer_id',
        'date',
        'total',
        'tax',
        'note',
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

//    protected $with = ['provider'];
//
//    public function provider()
//    {
//        return $this->belongsTo(ProviderModel::class, 'provider_id', 'id');
//    }

}