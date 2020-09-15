<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use App\Shared\Action\ActionCommandRemove;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DataMasterRemoveAction extends DataMasterAction
{
    protected function action(): Response
    {
        try {
            $argUuid = $this->resolveArg('uuid');
            return $this->commandSuccess($this->dataMasterRemoveService->executeArg($argUuid));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}