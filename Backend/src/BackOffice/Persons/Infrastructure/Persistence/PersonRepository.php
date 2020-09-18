<?php
namespace App\BackOffice\Persons\Infrastructure\Persistence;

use App\BackOffice\Persons\Domain\Entities\PersonModel;
use App\BackOffice\Persons\Domain\Repository\PersonRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class PersonRepository extends BaseRepository implements PersonRepositoryInterface
{
    public PersonModel $personModel;

    public function __construct(PersonModel $PersonModel)
    {
        $this->personModel = $PersonModel;
        $this->setModel($PersonModel);
    }

    public function addPerson(array $Person): bool
    {
        try {
            $addPerson = $this->personModel::create($Person);
            return $addPerson->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editPerson(int $id, array $userType): bool
    {
        try {
            $editPerson = $this->personModel::all()->find($id);
            return $editPerson->update($userType);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findPerson(int $id): array
    {
        $findPerson = $this->personModel::all()->find($id);
        return $findPerson->toArray();
    }

    public function removePerson(int $id): bool
    {
        try {
            $editPerson = $this->personModel::all()->find($id);
            $editPerson->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editPerson->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allPersons(array $query): object
    {
          return $this->paginateModel($query, $this->personModel);
    }

}