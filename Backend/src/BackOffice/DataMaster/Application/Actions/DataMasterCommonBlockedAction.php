<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class DataMasterCommonBlockedAction extends DataMasterAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->dataMasterFindAllService->executeCommonBlockedUser());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}