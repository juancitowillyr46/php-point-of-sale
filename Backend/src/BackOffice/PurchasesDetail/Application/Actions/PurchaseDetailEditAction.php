<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PurchaseDetailEditAction extends PurchasesDetailAction
{
    protected function action(): Response
    {
        try {

            $purchaseId = $this->resolveArg('purchaseId');

            $purchaseIdDetail = $this->resolveArg('id');

            $bodyParsed = $this->getFormData();

            return $this->commandSuccess($this->purchaseDetailEditService->executeArgWithBodyParsedWithRef($purchaseId, $purchaseIdDetail, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}