<?php
namespace App\BackOffice\Products\Application\Actions;

use App\Shared\Action\ActionCommandAdd;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class AddProductAction extends ActionCommandAdd
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
            return $this->commandSuccess($this->add());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }

}