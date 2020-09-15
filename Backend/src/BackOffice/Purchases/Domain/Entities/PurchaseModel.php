<?php
namespace App\BackOffice\Purchases\Domain\Entities;

use App\BackOffice\Employees\Domain\Entities\EmployeeModel;
use App\BackOffice\Providers\Domain\Entities\ProviderModel;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
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

    protected $with = ['provider', 'employee'];

    // public function detail()
    // {
    //  return $this->hasMany(PurchaseDetailModel::class, 'buy_id', 'id');
    // }

    public function provider()
    {
        // return $this->belongsTo(UserTypeModel::class, 'user_type_id', 'id');
        return $this->belongsTo(ProviderModel::class, 'provider_id', 'id');
    }

    public function employee()
    {
        // return $this->belongsTo(UserTypeModel::class, 'user_type_id', 'id');
        return $this->belongsTo(EmployeeModel::class, 'employee_id', 'id');
    }
}