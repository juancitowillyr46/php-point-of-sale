<?php
namespace App\BackOffice\MeasureUnits\Application\Actions;

use App\Shared\Action\ActionCommandAdd;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class AddMeasureUnitAction extends ActionCommandAdd
{
    public MeasureUnitsAction $action;

    public function __construct(LoggerInterface $logger, MeasureUnitsAction $action)
    {
        $this->action = $action;
        $this->setValidator($this->action->validateSchema);
        $this->setService($this->action->service);
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        try {
            return $this->commandSuccess($this->add());
        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }

}