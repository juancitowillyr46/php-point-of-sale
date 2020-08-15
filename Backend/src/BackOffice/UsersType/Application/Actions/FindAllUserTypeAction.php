<?php


namespace App\BackOffice\UsersType\Application\Actions;


use App\Shared\Action\Action;
use App\Shared\Action\ActionCommandFindAll;
use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class FindAllUserTypeAction extends ActionCommandFindAll
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
            return $this->commandSuccess($this->findAll());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }
}