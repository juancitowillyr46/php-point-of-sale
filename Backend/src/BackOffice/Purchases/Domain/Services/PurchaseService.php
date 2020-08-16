<?php
namespace App\BackOffice\Purchases\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMaster;
use App\BackOffice\DataMaster\Domain\Services\DataMasterService;
use App\BackOffice\Purchases\Domain\Entities\Purchase;
use App\BackOffice\Purchases\Domain\Entities\PurchaseDto;
use App\BackOffice\Purchases\Domain\Entities\PurchaseMapper;
use App\BackOffice\Purchases\Infrastructure\Persistence\PurchaseRepository;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class PurchaseService extends BaseService
{
    public PurchaseMapper $mapper;
    public Purchase $purchase;
    public PurchaseRepository $purchaseRepository;
    public DataMasterService $dataMasterService;

    public function __construct(PurchaseMapper $mapper, PurchaseRepository $purchaseRepository, Purchase $purchase, DataMasterService $dataMasterService)
    {
        $this->mapper = $mapper;
        $this->purchase = $purchase;
        $this->purchaseRepository = $purchaseRepository;
        $this->dataMasterService = $dataMasterService;
        $this->setRepository($purchaseRepository);
    }

    public function payLoad(object $request): array
    {

        try {

            $purchase = $this->purchase;

            // Datos de la cabecera
            if($request->uuid != "") {
                $purchase->setUuid($request->uuid);
            } else {
                $purchase->setUuid(UuidGenerate::uuid1());
            }

            $purchase->setNumDocument($request->numDocument);
            $purchase->setSerieDocument($request->serieDocument);
            $purchase->setDate($request->date);
            //$purchase->setProviderId($request->numDocument);

            // Tipo documento
            $findDocumentType = $this->dataMasterService->find($request->documentTypeUuid);
            $purchase->setDocumentTypeId($findDocumentType['id']);

            // Estado de la compra
            $findStatus = $this->dataMasterService->find($request->statusUuid);
            $purchase->setStatusId($findStatus['id']);

            // Empleado
            $purchase->setEmployeeId(1);

            $purchase->setProviderId(1);

            $purchase->setTotal((float) $request->total);
            $purchase->setActive($request->active);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $purchase;
    }

    public function findToDto(string $uuid) {
        return $this->mapper->autoMapper->map($this->find($uuid), PurchaseDto::class);
    }

    /*public function validateDuplicate(array $request): void {

        $existEmail = $this->userRepository->findByAttr('email', $request['email'], $request['uuid']);
        if($existEmail) {
            throw new DuplicateActionException();
        }

        $existUsername = $this->userRepository->findByAttr('username', $request['username'], $request['uuid']);
        if($existUsername) {
            throw new DuplicateActionException();
        }

    }*/

}