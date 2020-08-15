<?php
namespace App\BackOffice\Products\Application\Actions;

use App\Shared\Action\ActionCommandRemove;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class RemoveProductAction extends ActionCommandRemove
{

    public ProductsAction $action;

    public function __construct(LoggerInterface $logger, ProductsAction $action)
    {
        $this->action = $action;
        $this->setValidator($this->action->validateSchema);
        $this->setService($this->action->service);
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