<?php
namespace App\Shared\Domain\Services;

use App\Shared\Domain\Uuid;
use App\Shared\Exception\Commands\AddActionException;
use App\Shared\Exception\Commands\EditActionException;
use App\Shared\Exception\Commands\FindActionException;
use App\Shared\Exception\Commands\FindAllActionException;
use App\Shared\Exception\Commands\NotEqualResourceException;
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

        $request['created_at'] = date('Y-m-d H:i:s');
        $request['created_by'] = 'ADMIN';
        $success = $this->repository->add($request);
        if(!$success)
            throw new AddActionException();

        $uuid = new Uuid();
        $uuid->setUuid($request['uuid']);
        return $uuid;
    }

    public function edit(array $request, string $uuid): Uuid
    {
        if($request['uuid'] !== $uuid)
            throw new NotEqualResourceException();

        $findId = $this->repository->findByUuid($uuid);

        if(!$findId)
            throw new FindActionException();

        $request['id'] = $findId;
        $request['updated_at'] = date('Y-m-d H:i:s');
        $request['updated_by'] = 'ADMIN';

        $success = $this->repository->edit($request, $findId);
        if(!$success)
            throw new EditActionException();

        $uuid = new Uuid();
        $uuid->setUuid($request['uuid']);
        return $uuid;
    }

    public function remove(string $uuid): Uuid
    {
        $findId = $this->repository->findByUuid($uuid);

        if(!$findId)
            throw new FindActionException();

        $success = $this->repository->remove($findId);
        if(!$success)
            throw new RemoveActionException();

        $uuidGenerate = new Uuid();
        $uuidGenerate->setUuid($uuid);
        return $uuidGenerate;
    }

    public function find(string $uuid): array
    {
        $findId = $this->repository->findByUuid($uuid);

        if(!$findId)
            throw new FindActionException();

        return $this->repository->find($findId);
    }

    public function all(?array $query): array
    {
        $findAll = $this->repository->all($query);
        if(!$findAll) {
            throw new FindAllActionException();
        }
        return $findAll;
    }

    public function allById(string $key, string $value): array
    {
        $findAll = $this->repository->allById($key, $value);
        if(!$findAll) {
            throw new FindAllActionException();
        }
        return $findAll;
    }

    public function findById(int $id): array {
        $findId = $this->repository->find($id);
        if(!$findId)
            throw new FindActionException();

        return $findId;
    }

    abstract public function payLoad(object $request): array;
    //abstract public function findDetailByUuid(string $uuidRef): array;
}