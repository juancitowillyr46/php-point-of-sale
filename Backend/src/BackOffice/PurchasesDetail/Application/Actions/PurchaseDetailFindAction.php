<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PurchaseDetailFindAction extends PurchasesDetailAction
{
    protected function action(): Response
    {
        try {

            $purchaseId = $this->resolveArg('purchaseId');

            $purchaseDetailId = $this->resolveArg('id');

            return $this->commandSuccess($this->purchaseDetailFindService->executeArgDetail($purchaseId, $purchaseDetailId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}