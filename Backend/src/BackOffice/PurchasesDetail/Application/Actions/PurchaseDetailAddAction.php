<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PurchaseDetailAddAction extends PurchasesDetailAction
{
    protected function action(): Response
    {
        try {

            $purchaseId = $this->resolveArg('purchaseId');

            $bodyParsed = $this->getFormData();

            return $this->commandSuccess($this->purchaseDetailAddService->executeWithIdRef($purchaseId, $bodyParsed));
        } catch (Exception $ex) {
            $this->logger->error('Message:'.$ex->getMessage().'|Code:'. $ex->getCode().'|Line:'. $ex->getLine().'|File:'. $ex->getFile());
            return $this->commandError($ex);
        }
    }

}