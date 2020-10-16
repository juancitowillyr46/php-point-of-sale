<?php
namespace App\BackOffice\Purchases\Domain\Entities;

use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseModel extends Model
{
    protected $table = "purchase";

    protected $fillable = [
        'id',
        'uuid',
        'provider_id',
        'document_type_id',
        'document_number',
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

    protected $with = ['provider'];

    // public function detail()
    // {
    //  return $this->hasMany(PurchaseDetailModel::class, 'buy_id', 'id');
    // }

    public function provider()
    {
        return $this->belongsTo(ProviderModel::class, 'provider_id', 'id');
    }

}