<?php
namespace App\BackOffice\Purchases\Application\Actions;

use App\Shared\Action\ActionCommandFindAll;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class PurchaseFindAllAction extends PurchasesAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->purchaseFindAllService->executeCollection($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}