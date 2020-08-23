<?php
namespace App\BackOffice\PurchasesDetail\Application\Actions;

use App\BackOffice\PurchasesDetail\Domain\Services\PurchaseDetailService;
use App\Shared\Action\ActionCommandFindAll;
use App\Shared\Action\BaseActionCommand;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class FindAllDetailPurchaseDetailAction  extends BaseActionCommand
{

    public LoggerInterface $logger;
    public PurchaseDetailService $purchaseDetailService;

    public function __construct(LoggerInterface $logger, PurchaseDetailService $purchaseDetailService)
    {
        $this->purchaseDetailService = $purchaseDetailService;
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        try {

            $uuidPurchase = $this->resolveArg('uuidPurchase');

            return $this->commandSuccess($this->purchaseDetailService->findDetailByUuid($uuidPurchase));

        } catch (Exception $e) {

            return $this->commandError($e);

        }
    }
}