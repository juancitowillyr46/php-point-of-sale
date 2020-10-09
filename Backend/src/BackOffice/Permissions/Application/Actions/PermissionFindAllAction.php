<?php
namespace App\BackOffice\Permissions\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class PermissionFindAllAction extends PermissionAction
{

    protected function action(): Response
    {
        try {
            $query = $this->request->getQueryParams();
            return $this->commandSuccess($this->permissionFindAllService->executeCollectionPagination($query));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}