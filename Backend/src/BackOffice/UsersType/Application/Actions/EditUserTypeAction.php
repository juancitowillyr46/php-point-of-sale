<?php
namespace App\BackOffice\UsersType\Application\Actions;

use App\Shared\Action\ActionCommandEdit;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class EditUserTypeAction extends ActionCommandEdit
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
            return $this->commandSuccess($this->edit());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }
}