<?php
namespace App\Shared\Infrastructure\Persistence;

use App\Shared\Domain\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;

class BaseRepository implements RepositoryInterface
{
    private Model $model;

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



    public function add(array $request): bool
    {
        $add = $this->model->fill($request);
        try {
            return $add->saveOrFail($request);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
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
        $edit->update(["active" => false]);
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
        return $this->model::all();
    }

    public function findByUuid(string $uuid): ?int
    {
        $find = $this->model::all()->where('uuid', $uuid)->first();
        return ($find)? $find->getAttribute('id') : null;
    }
}