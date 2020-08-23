<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\Products\Domain\Services\ProductService;
use App\BackOffice\Purchases\Domain\Services\PurchaseService;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetail;
use App\BackOffice\PurchasesDetail\Domain\Exceptions\PurchaseDetailValidateSchema;
use App\BackOffice\PurchasesDetail\Infrastructure\Persistence\PurchaseDetailRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class AddItemToPurchaseService extends BaseService
{
    public PurchaseDetailValidateSchema $purchaseDetailSchema;
    public PurchaseDetailRepository $purchaseDetailRepository;
    public ProductService $productService;
    public PurchaseService $purchaseService;

    public function __construct(
        PurchaseDetailValidateSchema $purchaseDetailSchema,
        PurchaseDetailRepository $purchaseDetailRepository,
        ProductService $productService,
        PurchaseService $purchaseService
    )
    {
        $this->purchaseDetailSchema = $purchaseDetailSchema;
        $this->purchaseDetailRepository = $purchaseDetailRepository;
        $this->productService = $productService;
        $this->purchaseService = $purchaseService;
    }

    public function execute(array $requestBody, string $uuidPurchase): bool
    {
        // Validate
        try {

            $this->validatePayload($requestBody);

            $findPurchase = $this->purchaseService->find($uuidPurchase);

            $countRequestBody = count($requestBody);
            $countSuccess = 0;

            // Usando el body
            foreach ($requestBody as $item) {
                if($this->addPayload($item, (int) $findPurchase['id'])){
                    $countSuccess = $countSuccess + 1;
                }
            }

            return ($countSuccess == $countRequestBody);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

    public function addPayload(object $item, int $idPurchase) {
        try {
            $findProduct = $this->productService->find($item->uuidProduct);
            $addPurchaseDetail = new PurchaseDetail();
            $addPurchaseDetail->setBuyId($idPurchase);
            $addPurchaseDetail->setPrice((float) $item->price);
            $addPurchaseDetail->setQuantity((int) $item->quantity);
            $addPurchaseDetail->setProductId($findProduct['id']);
            $addPurchaseDetail->setCreatedAt(date('Y-m-d H:i:s'));
            $addPurchaseDetail->setCreatedBy('ADMIN');
            $addPurchaseDetail->setUuid(UuidGenerate::uuid1());
            $addPurchaseDetail->setActive(1);
            return $this->purchaseDetailRepository->add((array)$addPurchaseDetail);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function validatePayload($requestBody) {
        try {
            foreach ($requestBody as $body) {
                $this->purchaseDetailSchema->getMessages((array) $body);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }


    public function payLoad(object $request): array
    {
        return (array) $request;
    }
}