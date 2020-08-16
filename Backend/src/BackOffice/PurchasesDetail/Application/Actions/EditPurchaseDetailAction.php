<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use App\Shared\Action\ActionCommandEdit;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class EditPurchaseDetailAction extends ActionCommandEdit
{
    public PurchasesDetailAction $action;

    public function __construct(LoggerInterface $logger, PurchasesDetailAction $action)
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