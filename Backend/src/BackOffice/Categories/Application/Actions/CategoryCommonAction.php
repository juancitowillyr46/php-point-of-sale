<?php
namespace App\BackOffice\Categories\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class CategoryCommonAction extends CategoriesAction
{

    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->categoryFindAllService->executeCommon());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}