<?php
namespace App\BackOffice\PurchasesDetail\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetailModel extends Model
{
    protected $table = "buy_detail";

    protected $fillable = [
        'id',
        'uuid',
        'buy_id',
        'product_id',
        'quantity',
        'price',
        'active',
        'created_at',
        'created_by'
    ];

    use SoftDeletes;

    const UPDATED_AT = null;

}