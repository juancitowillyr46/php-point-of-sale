<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use App\Shared\Action\ActionCommandRemove;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseDetailRemoveAction extends PurchasesDetailAction
{
    protected function action(): Response
    {
        try {

            $purchaseId = $this->resolveArg('purchaseId');

            $purchaseDetailId = $this->resolveArg('id');

//            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->purchaseDetailRemoveService->executeArgDetail($purchaseId, $purchaseDetailId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}