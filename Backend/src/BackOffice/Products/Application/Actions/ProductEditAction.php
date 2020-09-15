<?php
namespace App\BackOffice\Products\Application\Actions;

use App\Shared\Action\ActionCommandEdit;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ProductEditAction extends ProductsAction
{

    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->productEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}