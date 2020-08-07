<?php
namespace App\Shared\Domain\Services;

use App\Shared\Domain\Uuid;
use App\Shared\Exception\Commands\AddActionException;
use App\Shared\Exception\Commands\EditActionException;
use App\Shared\Exception\Commands\FindActionException;
use App\Shared\Exception\Commands\FindAllActionException;
use App\Shared\Exception\Commands\RemoveActionException;
use App\Shared\Infrastructure\Persistence\BaseRepository;

abstract class BaseService implements ServiceInterface
{

    private BaseRepository $repository;

    /**
     * @return BaseRepository
     */
    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    /**
     * @param BaseRepository $repository
     */
    public function setRepository(BaseRepository $repository): void
    {
        $this->repository = $repository;
    }

    public function add(array $request): Uuid
    {
        $success = $this->repository->add($request);
        if(!$success){
            throw new AddActionException();
        }
        $uuid = new Uuid();
        $uuid->setUuid($request['uuid']);
        return $uuid;
    }

    public function edit(array $request, int $id): Uuid
    {
        throw new EditActionException();
    }

    public function remove(string $uuid): Uuid
    {
        throw new RemoveActionException();
    }

    public function find(string $uuid): array
    {
        $findId = $this->repository->findByUuid($uuid);

        if(!$findId) {
            throw new FindActionException();
        }

        return $this->repository->find($findId);
    }

    public function all(?array $query): array
    {
        throw new FindAllActionException();
    }

    abstract public function payLoad(object $request): array;
}