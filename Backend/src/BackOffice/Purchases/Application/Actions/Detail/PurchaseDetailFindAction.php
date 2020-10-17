<?php
namespace App\BackOffice\Purchases\Application\Actions\Detail;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseDetailFindAction extends PurchasesDetailAction
{
    protected function action(): Response
    {
        try {

            $purchaseDetailId = $this->resolveArg('id');
            $purchaseId = $this->resolveArg('purchaseId');

            return $this->commandSuccess($this->purchaseDetailFindService->executeArgs($purchaseDetailId, $purchaseId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}