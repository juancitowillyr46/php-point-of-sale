<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailSchema;
use App\BackOffice\PurchasesDetail\Domain\Services\AddItemToPurchaseService;
use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailService;
use App\Shared\Action\ActionCommandAdd;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class AddPurchaseDetailAction extends ActionCommandAdd
{
    public LoggerInterface $logger;
    public AddItemToPurchaseService $addItemToPurchaseService;

    public function __construct(
        LoggerInterface $logger,
        AddItemToPurchaseService $addItemToPurchaseService
    )
    {
        $this->addItemToPurchaseService = $addItemToPurchaseService;
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        try {

            $uuidPurchase = $this->resolveArg('uuidPurchase');
            $formData = $this->getFormData();
            $success = $this->addItemToPurchaseService->execute((array) $formData, $uuidPurchase);
            return $this->commandSuccess($success);

        } catch (Exception $e) {
            return $this->commandError($e);
        }
    }

}