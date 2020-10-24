<?php
namespace App\BackOffice\Sales\Application\Actions\Detail;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SaleDetailEditAction extends SalesDetailAction {

    protected function action(): Response
    {
        try {
            $saleId = $this->resolveArg('saleId');
            $saleDetailId = $this->resolveArg('id');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->saleDetailEditService->executeArgsWithBodyParsed($saleDetailId, $saleId, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}