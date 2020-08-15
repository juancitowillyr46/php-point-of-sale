<?php
namespace App\BackOffice\Categories\Domain\Services;

use App\BackOffice\Categories\Domain\Entities\Category;
use App\BackOffice\Categories\Domain\Entities\CategoryDto;
use App\BackOffice\Categories\Domain\Entities\CategoryMapper;
use App\BackOffice\Categories\Infrastructure\Persistence\CategoryRepository;
use App\BackOffice\Users\Domain\Entities\User;
use App\BackOffice\Users\Domain\Entities\UserDto;
use App\BackOffice\Users\Domain\Entities\UserMapper;
use App\BackOffice\UsersType\Domain\Services\UserTypeService;
use App\Shared\Domain\Services\BaseService;
use App\Shared\Exception\Commands\DuplicateActionException;
use App\Shared\Utility\SecurityPassword;
use Exception;
use Ramsey\Uuid\Uuid as UuidGenerate;

class CategoryService extends BaseService
{
    public CategoryMapper $mapper;
    public Category $category;
    public CategoryRepository $categoryRepository;

    public function __construct(CategoryMapper $mapper, CategoryRepository $categoryRepository, Category $category)
    {
        $this->mapper = $mapper;
        $this->category = $category;
        $this->categoryRepository = $categoryRepository;
        $this->setRepository($categoryRepository);
    }

    public function payLoad(object $request): array
    {

        try {

            //$this->validateDuplicate((array) $request);

            $category = $this->category;

            if($request->uuid != "") {
                $category->setUuid($request->uuid);
            } else {
                $category->setUuid(UuidGenerate::uuid1());
            }

            $category->setDescription($request->description);
            $category->setName($request->name);
            $category->setActive($request->active);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        /* Ubicar el id del typeUserUuid */
        return (array) $category;
    }

    public function findToDto(string $uuid) {
        return $this->mapper->autoMapper->map($this->find($uuid), CategoryDto::class);
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