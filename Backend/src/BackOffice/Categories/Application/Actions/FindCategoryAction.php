<?php
namespace App\BackOffice\Categories\Application\Actions;

use App\Shared\Action\ActionCommandFind;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class FindCategoryAction extends ActionCommandFind
{
    public CategoriesAction $action;

    public function __construct(LoggerInterface $logger, CategoriesAction $action)
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