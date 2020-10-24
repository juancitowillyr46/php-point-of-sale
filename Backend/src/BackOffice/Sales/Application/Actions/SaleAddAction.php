<?php
namespace App\BackOffice\Sales\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SaleAddAction extends SalesAction {

    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->saleAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            $this->logger->error('Message:'.$ex->getMessage().'|Code:'. $ex->getCode().'|Line:'. $ex->getLine().'|File:'. $ex->getFile());
            return $this->commandError($ex);
        }
    }
}