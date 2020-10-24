<?php
namespace App\Shared\Infrastructure\Persistence;

use App\BackOffice\Purchases\Domain\Entities\PurchaseModel;
use App\Shared\Domain\Entities\PaginateEntity;
use App\Shared\Domain\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;
use Psr\Log\LoggerInterface;
use stdClass;
use Throwable;

class BaseRepository implements RepositoryInterface
{
//    private LoggerInterface $loggerInterface;

    private Model $model;

//    public function __construct(LoggerInterface $loggerInterface)
//    {
//        $this->loggerInterface = $loggerInterface;
//    }
    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }


    public function findResourceByUuid(string $uuid): ?int
    {
        $find = $this->model::all()->where('uuid', '=' ,$uuid)->first();
        return ($find)? $find->getAttribute('id') : null;
    }

    public function add(array $request): bool
    {
        try {
            $add = $this->model::create($request);
            return $add->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function edit(array $request, int $id): bool
    {
        $edit = $this->model::all()->find($id);
        return $edit->update($request);
    }

    public function remove(int $id): bool
    {

        $edit = $this->model::all()->find($id);
        $edit->update(["active" => false, "deleted_by" => "ADMIN"]);
        try {
            return $edit->delete();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function find(int $id): array
    {
        $find = $this->model::all()->find($id);
        return $find->toArray();
    }

    public function all(?array $query): array
    {
        return $this->model::all()->where('active', '=', true)->toArray();
    }

    public function allById(string $key, string $value): array
    {
        return $this->model::all()->where($key, $value)->toArray();
    }

    public function findByUuid(string $uuid): ?int
    {
        $find = $this->model::all()->where('uuid', '=' ,$uuid)->first();
        return ($find)? $find->getAttribute('id') : null;
    }

    public function findByAttr(string $key, string $value, string $uuid): bool {
        $count = $this->model::all()->where($key, $value)->where('uuid', '!=', $uuid)->count();
        return $count > 0;
    }

    public function paginateModel(array $query, Model $model): object {

        try {

            $findAll = $model::all()
                ->sortByDesc('id')
                ->skip(((int)$query['page'] - 1) * $query['size'])
                ->take((int)$query['size'])
                ->toArray();

            $paginate = new PaginateEntity();
            $paginate->setRows($findAll);
            $paginate->setTotalRows($model::all()->count());
            $paginate->setTotalPages(ceil($model::all()->count()/(int)$query['size']));
            return $paginate;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }

    public function paginateModelParent(Model $model, array $query, int $parentId, string $parentCondition): object {

        try {

            $findAll = $model::all()
                ->where('purchase_id', '=', $parentId)
                ->sortByDesc('id')
                ->skip(((int)$query['page'] - 1) * $query['size'])
                ->take((int)$query['size'])
                ->toArray();

            $paginate = new PaginateEntity();
            $paginate->setRows($findAll);
            $paginate->setTotalRows($model::all()->count());
            $paginate->setTotalPages(ceil($model::all()->count()/(int)$query['size']));
            return $paginate;

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }

    }
}