<?php
namespace App\BackOffice\Purchases\Application\Actions\Detail;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseDetailEditAction extends PurchasesDetailAction {

    protected function action(): Response
    {
        try {
            $purchaseId = $this->resolveArg('purchaseId');
            $purchaseDetailId = $this->resolveArg('id');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->purchaseDetailEditService->executeArgsWithBodyParsed($purchaseDetailId, $purchaseId, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}