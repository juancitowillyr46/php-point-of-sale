<?php
namespace App\BackOffice\Sales\Application\Actions\Detail;

use App\Shared\Action\ActionCommandRemove;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SaleDetailRemoveAction extends SalesDetailAction
{
    protected function action(): Response
    {
        try {
            $id = $this->resolveArg('id');
            $saleId = $this->resolveArg('saleId');
            return $this->commandSuccess($this->saleDetailRemoveService->executeArgs($id, $saleId));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}