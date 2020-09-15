<?php
namespace App\BackOffice\Products\Application\Actions;

use App\Shared\Action\ActionCommandAdd;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ProductAddAction extends ProductsAction
{
    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->productAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}