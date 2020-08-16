<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use App\BackOffice\DataMaster\Domain\Exceptions\DataMasterActionRequestSchema;
use App\BackOffice\DataMaster\Domain\Services\DataMasterervice;
use Psr\Log\LoggerInterface;

class DataMasterAction
{
    public DataMasterActionRequestSchema $validateSchema;
    public DataMasterervice $service;
    public LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, DataMasterActionRequestSchema $validateSchema, DataMasterervice $service)
    {
        $this->validateSchema = $validateSchema;
        $this->service = $service;
        $this->logger = $logger;
    }
}

