<?php
namespace App\BackOffice\Users\Application\Actions;

use App\BackOffice\Users\Domain\Exceptions\UserActionRequestSchema;
use App\BackOffice\Users\Domain\Services\UserService;
use App\Shared\Action\ActionCommandAdd;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class AddUserAction extends ActionCommandAdd
{
    public function __construct(LoggerInterface $logger, UserService $userService, UserActionRequestSchema $validateSchema)
    {
        $this->setValidator($validateSchema);
        $this->setService($userService);
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->add());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }

}