<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use App\Shared\Action\ActionCommandEdit;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DataMasterEditAction extends DataMasterAction
{
    protected function action(): Response
    {
        try {

            $argUuid = $this->resolveArg('uuid');
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->dataMasterEditService->executeArgWithBodyParsed($argUuid, $bodyParsed));

        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }
}