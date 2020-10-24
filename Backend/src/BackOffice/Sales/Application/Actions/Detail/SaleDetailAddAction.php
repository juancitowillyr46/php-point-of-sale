<?php
namespace App\BackOffice\Sales\Application\Actions\Detail;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SaleDetailAddAction extends SalesDetailAction {

    protected function action(): Response
    {
        try {
            $saleId = $this->resolveArg('saleId');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->saleDetailAddService->executeArgWithBodyParsed($saleId, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}