<?php


namespace App\BackOffice\Sales\Domain\Entities\Detail;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetailModel extends Model
{
    protected $table = "sale_detail";

    protected $fillable = [
        'id',
        'uuid',
        'sale_id',
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