<?php
namespace App\BackOffice\DataMaster\Infrastructure\Persistence;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;

class DataMasterRepository extends BaseRepository
{
    public function __construct(DataMasterModel $model)
    {
        $this->setModel($model);
    }

}