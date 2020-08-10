<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Exceptions\UserActionRequestSchema;
use App\BackOffice\Users\Domain\Services\UserService;
use App\Shared\Action\ActionCommandFindAll;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class FindUserAllAction extends ActionCommandFindAll
{
    public function __construct(LoggerInterface $logger, UserService $serviceCommand, UserActionRequestSchema $validateSchema)
    {
        $this->setValidator($validateSchema);
        $this->setService($serviceCommand);
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->findAll());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }
}