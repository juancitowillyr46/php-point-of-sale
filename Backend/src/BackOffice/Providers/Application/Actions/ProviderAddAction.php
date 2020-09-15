<?php
namespace App\BackOffice\Categories\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ProviderAddAction extends CategoriesAction
{

    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->providerAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}