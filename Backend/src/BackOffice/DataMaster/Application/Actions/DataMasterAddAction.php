<?php
namespace App\BackOffice\DataMaster\Application\Actions;

use App\Shared\Action\ActionCommandAdd;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DataMasterAddAction extends DataMasterAction
{
    protected function action(): Response
    {
        try {
            $bodyParsed = $this->getFormData();
            return $this->commandSuccess($this->dataMasterAddService->execute($bodyParsed));
        } catch (Exception $ex) {
            return $this->commandError($ex);
        }
    }

}