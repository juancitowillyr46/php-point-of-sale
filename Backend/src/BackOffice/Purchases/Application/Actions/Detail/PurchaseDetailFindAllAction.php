<?php
namespace App\BackOffice\Purchases\Application\Actions\Detail;

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
            $purchaseId = $this->resolveArg('purchaseId');
            return $this->commandSuccess($this->purchaseDetailFindAllService->executeCollectionPagination($purchaseId, $query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}