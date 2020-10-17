<?php


namespace App\BackOffice\Purchases\Domain\Entities\Detail;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetailModel extends Model
{
    protected $table = "purchase_detail";

    protected $fillable = [
        'id',
        'uuid',
        'purchase_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
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