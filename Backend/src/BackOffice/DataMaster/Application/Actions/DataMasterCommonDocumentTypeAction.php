<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class DataMasterCommonDocumentTypeAction extends DataMasterAction
{
    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->dataMasterFindAllService->executeCommonDocumentTypes());
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}