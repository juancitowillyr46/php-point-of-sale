<?php
namespace App\BackOffice\Customers\Infrastructure\Persistence;

use App\BackOffice\Customers\Domain\Entities\CustomerModel;
use App\BackOffice\Customers\Domain\Repository\CustomerRepositoryInterface;
use App\Shared\Exception\Database\ExceptionEloquent;
use App\Shared\Infrastructure\Persistence\BaseRepository;
use Exception;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public CustomerModel $customerModel;

    public function __construct(CustomerModel $customerModel)
    {
        $this->customerModel = $customerModel;
        $this->setModel($customerModel);
    }

    public function addCustomer(array $customer): bool
    {
        try {
            $addCustomer = $this->customerModel::create($customer);
            return $addCustomer->save();
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function editCustomer(int $id, array $customer): bool
    {
        try {
            $editCustomer = $this->customerModel::all()->find($id);
            return $editCustomer->update($customer);
        } catch (Exception $ex) {
            throw new ExceptionEloquent($ex->getMessage(), $ex->getCode());
        }
    }

    public function findCustomer(int $id): array
    {
        $findCustomer = $this->customerModel::all()->find($id);
        return $findCustomer->toArray();
    }

    public function removeCustomer(int $id): bool
    {
        try {
            $editCustomer = $this->customerModel::all()->find($id);
            $editCustomer->update(["active" => false, "deleted_by" => "ADMIN"]);
            return $editCustomer->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function allCustomers(array $query): object
    {
        return $this->paginateModel($query, $this->customerModel);
    }

    public function commonCustomers(): array
    {
        try {

            return $this->customerModel::all()
                ->where('active', '=', true)
                ->toArray();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }

}