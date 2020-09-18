<?php
namespace App\BackOffice\Users\Infrastructure\Persistence;

use App\BackOffice\Users\Domain\Entities\UserModel;
use App\BackOffice\Users\Domain\Repository\UserRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;
use stdClass;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;

        // TODO: Para el Base Repository
        $this->setModel($userModel);
    }

    public function addUser(array $user): bool
    {
        try {
            $addUser = $this->userModel::create($user);
            return $addUser->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editUser(int $id, array $user): bool
    {
        try {
            $editUser = $this->userModel::all()->find($id);
            return $editUser->update($user);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findUser(int $id): array
    {
        $find = $this->userModel::all()->find($id);
        return $find->toArray();
    }

    public function removeUser(int $id): bool
    {
        try {
            $edit = $this->userModel::all()->find($id);
            $edit->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $edit->delete();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allUsers(array $query): object
    {
        if(!array_key_exists('size', $query)) {
            throw new Exception('size not found');
        } else if(!array_key_exists('page', $query) || ($query['page']*1) < 1) {
            throw new Exception('page not found');
        } else if(!array_key_exists('active', $query)) {
            throw new Exception('active not found');
        }

        $findAllUser = $this->userModel::all();
        $getQuery = [];
        if(count($query)) {
            $getQuery = $findAllUser
                                    ->where('active', '=', (boolean) $query['active'])
                                    ->sortByDesc('id')
                                    ->skip(($query['page'] - 1) * $query['size'])
                                    ->take($query['size'])->toArray();
        } else {
            $getQuery = $findAllUser->toArray();
        }

        $class = new stdClass();
        $class->data = $getQuery;
        $class->totalRegister =  $findAllUser->count();

        return $class;
    }
}