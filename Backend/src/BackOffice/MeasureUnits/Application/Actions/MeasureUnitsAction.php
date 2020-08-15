<?php
namespace App\BackOffice\MeasureUnits\Application\Actions;

use App\BackOffice\MeasureUnits\Domain\Exceptions\MeasureUnitActionRequestSchema;
use App\BackOffice\MeasureUnits\Domain\Services\MeasureUnitService;
use Psr\Log\LoggerInterface;

class MeasureUnitsAction
{
    public MeasureUnitActionRequestSchema $validateSchema;
    public MeasureUnitService $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, MeasureUnitActionRequestSchema $validateSchema, MeasureUnitService $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}

