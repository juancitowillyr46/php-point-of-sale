<?php
namespace App\BackOffice\Purchases\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseAddAction extends PurchasesAction {

    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->purchaseAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            $this->logger->error('Message:'.$ex->getMessage().'|Code:'. $ex->getCode().'|Line:'. $ex->getLine().'|File:'. $ex->getFile());
            return $this->commandError($ex);
        }
    }
}