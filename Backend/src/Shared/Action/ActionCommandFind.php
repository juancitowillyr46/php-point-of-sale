<?php
namespace App\Shared\Action;

use App\BackOffice\Users\Domain\Exceptions\UserActionRequestSchema;
use App\BackOffice\Users\Domain\Services\UserService;
use Exception;
use Psr\Log\LoggerInterface;

abstract class ActionCommandFind extends BaseActionCommand
{
//    public function __construct(LoggerInterface $logger, UserService $serviceCommand, UserActionRequestSchema $validateSchema)
//    {
//        $this->setValidator($validateSchema);
//        $this->setService($serviceCommand);
//        parent::__construct($logger);
//    }

    public function find() {

        try {

            $uuid = $this->resolveArg('uuid');

            return $this->service->findToDto($uuid);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

}