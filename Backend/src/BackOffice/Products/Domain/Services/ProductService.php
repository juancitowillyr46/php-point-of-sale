<?php
namespace App\BackOffice\Products\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\Category;
use App\BackOffice\Categories\Domain\Services\CategoryService;
use App\BackOffice\MeasureUnits\Domain\Services\MeasureUnitService;
use App\BackOffice\Products\Domain\Entities\Product;
use App\BackOffice\Products\Domain\Entities\ProductDto;
use App\BackOffice\Products\Domain\Entities\ProductMapper;
use App\BackOffice\Products\Infrastructure\Persistence\ProductRepository;
use App\BackOffice\Users\Domain\Exceptions\DuplicateCodeException;
use App\Shared\Domain\Services\BaseService;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class ProductService extends BaseService
{
    public ProductMapper $mapper;
    public Product $product;
    public ProductRepository $repository;
    public CategoryService $categoryService;
    public MeasureUnitService $measureUnitService;

    public function __construct(
        ProductMapper $mapper,
        ProductRepository $repository,
        Product $product,
        CategoryService $categoryService,
        MeasureUnitService $measureUnitService)
    {
        $this->mapper = $mapper;
        $this->product = $product;
        $this->repository = $repository;
        $this->categoryService = $categoryService;
        $this->measureUnitService = $measureUnitService;
        $this->setRepository($repository);
    }

    public function payLoad(object $request): array
    {

        try {

            $this->validateDuplicate((array) $request);

            $product = $this->product;

            if($request->uuid != "") {
                $product->setUuid($request->uuid);
            } else {
                $product->setUuid(UuidGenerate::uuid1());
            }

            $product->setCode($request->code);
            $product->setName($request->name);
            $product->setDescription($request->description);
            $product->setActive($request->active);

            $findCategoryUuid = $this->categoryService->find($request->categoryUuid);
            $product->setIdCategory($findCategoryUuid['id']);

            $findMeasureUnitUuid = $this->measureUnitService->find($request->measureUnitUuid);
            $product->setIdUnitMeasurent($findMeasureUnitUuid['id']);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $product;
    }

    public function findToDto(string $uuid) {
        $find = $this->find($uuid);
        $find['category'] = $this->categoryService->findById($find['id_category']);
        $find['measureUnit'] = $this->measureUnitService->findById($find['id_unit_measurent']);
        return $this->mapper->autoMapper->map($find, ProductDto::class);
    }

    public function validateDuplicate(array $request): void {

        $existEmail = $this->repository->findByAttr('code', $request['code'], $request['uuid']);
        if($existEmail) {
            throw new DuplicateCodeException();
        }

    }

}