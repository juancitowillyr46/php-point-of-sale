<?php
namespace App\BackOffice\Sales\Application\Actions\Detail;

use App\Shared\Action\ActionCommandFindAll;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SaleDetailFindAllAction extends SalesDetailAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            $saleId = $this->resolveArg('saleId');
            return $this->commandSuccess($this->saleDetailFindAllService->executeCollectionPagination($saleId, $query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}