<?php
namespace App\BackOffice\Purchases\Application\Actions\Detail;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseDetailAddAction extends PurchasesDetailAction {

    protected function action(): Response
    {
        try {
            $purchaseId = $this->resolveArg('purchaseId');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->purchaseDetailAddService->executeArgWithBodyParsed($purchaseId, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}