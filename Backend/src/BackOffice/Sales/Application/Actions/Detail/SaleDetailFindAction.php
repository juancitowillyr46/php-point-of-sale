<?php
namespace App\BackOffice\Sales\Application\Actions\Detail;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SaleDetailFindAction extends SalesDetailAction
{
    protected function action(): Response
    {
        try {

            $saleDetailId = $this->resolveArg('id');
            $saleId = $this->resolveArg('saleId');

            return $this->commandSuccess($this->saleDetailFindService->executeArgs($saleDetailId, $saleId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}