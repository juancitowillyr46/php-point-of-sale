<?php
namespace App\BackOffice\PurchasesDetail\Domain\Services;

use App\BackOffice\DataMaster\Domain\Services\DataMasterService;
use App\BackOffice\Products\Domain\Services\ProductService;
use App\BackOffice\Purchases\Domain\Entities\Purchase;
use App\BackOffice\Purchases\Domain\Services\PurchaseService;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetail;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailDto;
use App\BackOffice\PurchasesDetail\Domain\Entities\PurchaseDetailMapper;
use App\BackOffice\PurchasesDetail\Infrastructure\Persistence\PurchaseDetailRepository;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\FindActionException;
use App\Shared\Exception\Commands\FindAllActionException;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class PurchaseDetailService extends BaseService
{
    public PurchaseDetailMapper $mapper;
    public PurchaseDetail $purchaseDetail;
    public PurchaseDetailRepository $purchaseDetailRepository;
    public DataMasterService $dataMasterService;
    public ProductService $productService;
    public PurchaseService $purchaseService;

    public function __construct(
        PurchaseDetailMapper $mapper,
        PurchaseDetailRepository $purchaseDetailRepository,
        PurchaseDetail $purchaseDetail,
        DataMasterService $dataMasterService,
        ProductService $productService,
        PurchaseService $purchaseService
    )
    {
        $this->mapper = $mapper;
        $this->purchaseDetail = $purchaseDetail;
        $this->purchaseDetailRepository = $purchaseDetailRepository;
        $this->dataMasterService = $dataMasterService;
        $this->productService = $productService;
        $this->purchaseService = $purchaseService;
        $this->setRepository($purchaseDetailRepository);
    }

    public function payLoad(object $request): array
    {

        try {

            $purchaseDetail = $this->purchaseDetail;

            // Datos de la cabecera
            if($request->uuid != "") {
                $purchaseDetail->setUuid($request->uuid);
            } else {
                $purchaseDetail->setUuid(UuidGenerate::uuid1());
            }

            $purchaseDetail->setNumDocument($request->numDocument);
            $purchaseDetail->setSerieDocument($request->serieDocument);
            $purchaseDetail->setDate($request->date);

            // Tipo documento
            $findDocumentType = $this->dataMasterService->find($request->documentTypeUuid);
            $purchaseDetail->setDocumentTypeId($findDocumentType['id']);

            // Estado de la compra
            $findStatus = $this->dataMasterService->find($request->statusUuid);
            $purchaseDetail->setStatusId($findStatus['id']);

            // Empleado
            $purchaseDetail->setEmployeeId(1);

            // Proveedor
            $purchaseDetail->setProviderId(1);

            $purchaseDetail->setTotal((float) $request->total);
            $purchaseDetail->setActive($request->active);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $purchaseDetail;
    }

    public function findToDto(string $uuid) {
        $find = $this->find($uuid);
        $findProduct = $this->productService->findById($find['product_id']);
        $find['product'] = $findProduct['name'];
        return $this->mapper->autoMapper->map($find, PurchaseDetailDto::class);
    }

    public function findDetailByUuid(string $uuidRef): array
    {
        try {

            $find = $this->purchaseService->find($uuidRef);
            $all = $this->allById('buy_id', $find['id']);
            $list = [];
            foreach($all as $item) {
                $list[] = $this->findToDto($item['uuid']);
            }
            return $list;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}