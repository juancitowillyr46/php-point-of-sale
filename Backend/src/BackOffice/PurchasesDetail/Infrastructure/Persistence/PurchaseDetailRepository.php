<?php
namespace App\BackOffice\PurchasesDetail\Infrastructure\Persistence;

use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;

class PurchaseDetailRepository extends BaseRepository
{
    public function __construct(PurchaseDetailModel $model)
    {
        $this->setModel($model);
    }

}