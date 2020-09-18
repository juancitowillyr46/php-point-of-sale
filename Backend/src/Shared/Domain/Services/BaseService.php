<?php
namespace App\Shared\Domain\Services;

use App\BackOffice\DataMaster\Domain\Entities\DataMasterModel;
use App\Shared\Domain\Uuid;
use App\Shared\Exception\Commands\AddActionException;
use App\Shared\Exception\Commands\EditActionException;
use App\Shared\Exception\Commands\EditVerifiedArgActionException;
use App\Shared\Exception\Commands\FindActionException;
use App\Shared\Exception\Commands\FindAllActionException;
use App\Shared\Exception\Commands\NotEqualResourceException;
use App\Shared\Exception\Commands\RemoveActionException;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use stdClass;

abstract class BaseService
    //implements ServiceInterface
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

    /*public function add(array $request): Uuid
    {

        $request['created_at'] = date('Y-m-d H:i:s');
        $request['created_by'] = 'ADMIN';
        $success = $this->repository->add($request);
        if(!$success)
            throw new AddActionException();

        $uuid = new Uuid();
        $uuid->setUuid($request['uuid']);
        return $uuid;
    }*/

    /*public function edit(array $request, string $uuid): Uuid
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
    }*/

    /*public function remove(string $uuid): Uuid
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
    }*/

    /*public function find(string $uuid): array
    {
        $findId = $this->repository->findByUuid($uuid);
        if(!$findId)
            throw new FindActionException();

        return $this->repository->find($findId);
    }*/

    /*public function all(?array $query): array
    {
        $findAll = $this->repository->all($query);
        if(!$findAll) {
            throw new FindAllActionException();
        }
        return $findAll;
    }*/

    /*public function allById(string $key, string $value): array
    {
        $findAll = $this->repository->allById($key, $value);
        if(!$findAll) {
            throw new FindAllActionException();
        }
        return $findAll;
    }*/

    /*public function findById(int $id): array {
        $findId = $this->repository->find($id);
        if(!$findId)
            throw new FindActionException();

        return $findId;
    }*/

    public function findResourceByUuid(Model $model, string $uuid): ?int
    {
        $find = $model::all()->where('uuid', '=' ,$uuid)->first();
        if(!$find)
            throw new FindActionException();

        return $find->getAttribute('id');
    }

    public function findCompareIdWithArg(string $uuid, string $id): void {
        if($uuid !== $id){
            throw new EditVerifiedArgActionException();
        }
    }

    public function findResourceByUuidReturnIdRegister(string $uuid): ?int
    {
        $dataModel = new DataMasterModel();
        $find = $dataModel::all()->where('uuid', '=' ,$uuid)->first();
        if(!$find)
            throw new FindActionException();

        return $find->getAttribute('id_register');
    }

    public function findNameResourceByUIdRegister(int $idRegister, string $type): string
    {
        $dataModel = new DataMasterModel();
        $find = $dataModel::all()->where('id_register', '=' ,$idRegister)->where('type', '=' ,$type)->first();
        if(!$find)
            throw new FindActionException();

        return $find->getAttribute('name');
    }

    abstract function execute(object $bodyParsed): object;

    abstract function executeArg(string $uuid): object;

    abstract function executeArgWithBodyParsed(string $uuid, object $bodyParsed): object;

    abstract function executeCollection(array $query): array;

    public function validatePagerParameters(array $query): void {

        if(count($query) == 0) {
            throw new Exception('No exist params');
        } else if(!array_key_exists('size', $query)) {
            throw new Exception('size not exist');
        } else if(!array_key_exists('page', $query)) {
            throw new Exception('page not exist');
        } else if( (int) $query['page'] < 1) {
            throw new Exception('Parameter not allowed');
        } else if( (int) $query['size'] < 1) {
            throw new Exception('Parameter not allowed');
        }

    }
}