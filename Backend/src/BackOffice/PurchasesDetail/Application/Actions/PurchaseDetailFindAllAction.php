<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use App\Shared\Action\ActionCommandFindAll;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseDetailFindAllAction extends PurchasesDetailAction
{
    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            $idRef = $this->resolveArg('purchaseId');
            return $this->commandSuccess($this->purchaseDetailFindAllService->executeCollectionDetail($idRef, $query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}