<?php
namespace App\BackOffice\Purchases\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseModel extends Model
{
    protected $table = "buy";

    protected $fillable = [
        'id',
        'uuid',
        'document_type_id',
        'num_document',
        'serie_document',
        'provider_id',
        'status_id',
        'date',
        'total',
        'tax',
        'employee_id',
        'active',
        'detail'
    ];

    use SoftDeletes;

    const UPDATED_AT = null;

    public function detail()
    {
        return $this->hasMany(PurchaseDetailModel::class, 'buy_id', 'id');
    }
}