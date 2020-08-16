<?php
namespace App\BackOffice\Purchases\Infrastructure\Persistence;

use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;

class PurchaseRepository extends BaseRepository
{
    public function __construct(PurchaseModel $model)
    {
        $this->setModel($model);
    }

    /*public function find(int $id): array
    {
        $find = $this->getModel()::with('detail')->find($id);
        return $find->toArray();
    }*/

}