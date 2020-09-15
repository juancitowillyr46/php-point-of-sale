<?php
namespace App\BackOffice\Purchases\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PurchaseEditAction extends PurchasesAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->purchaseEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}