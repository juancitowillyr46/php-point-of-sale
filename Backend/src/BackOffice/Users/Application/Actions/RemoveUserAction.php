<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Exceptions\UserActionRequestSchema;
use App\BackOffice\Users\Domain\Services\UserService;
use App\Shared\Action\ActionCommandRemove;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class RemoveUserAction extends ActionCommandRemove
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
            return $this->commandSuccess($this->remove());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }
}