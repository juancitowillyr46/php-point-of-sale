<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\Shared\Action\ActionCommandEdit;
use App\Shared\Action\ActionCommandFind;
use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class FindUserTypeAction extends ActionCommandFind
{
    public UsersTypeAction $action;

    public function __construct(LoggerInterface $logger, UsersTypeAction $action)
    {
        $this->action = $action;
        $this->setValidator($this->action->validateSchema);
        $this->setService($this->action->service);
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->find());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }
}