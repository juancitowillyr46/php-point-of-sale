<?php
namespace App\BackOffice\MeasureUnits\Infrastructure\Persistence;

use App\BackOffice\MeasureUnits\Domain\Entities\MeasureUnitModel;
use App\Shared\Infrastructure\Persistence\BaseRepository;

class MeasureUnitRepository extends BaseRepository
{
    public function __construct(MeasureUnitModel $model)
    {
        $this->setModel($model);
    }

}