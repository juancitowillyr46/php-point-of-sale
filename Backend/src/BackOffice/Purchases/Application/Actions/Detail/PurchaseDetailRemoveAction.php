<?php
namespace App\BackOffice\Purchases\Application\Actions\Detail;

use App\Shared\Action\ActionCommandRemove;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseDetailRemoveAction extends PurchasesDetailAction
{
    protected function action(): Response
    {
        try {
            $id = $this->resolveArg('id');
            $purchaseId = $this->resolveArg('purchaseId');
            return $this->commandSuccess($this->purchaseDetailRemoveService->executeArgs($id, $purchaseId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}