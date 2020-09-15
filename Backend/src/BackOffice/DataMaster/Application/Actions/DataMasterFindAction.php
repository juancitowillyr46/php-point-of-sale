<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use App\Shared\Action\ActionCommandFind;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DataMasterFindAction extends DataMasterAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->dataMasterFindService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}