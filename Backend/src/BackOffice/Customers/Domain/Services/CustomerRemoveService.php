<?php
namespace App\BackOffice\Customers\Domain\Services;

use App\BackOffice\Customers\Domain\Entities\CustomerModel;
use App\Shared\Exception\Commands\RemoveActionException;
use Exception;

class CustomerRemoveService extends CustomerService
{
    public function executeArg(string $uuid): object {
        try {

            $findUser = $this->findResourceByUuid(new CustomerModel(), $uuid);
            $success = $this->customerRepository->removeCustomer((int) $findUser);
            if(!$success) {
                throw new RemoveActionException();
            }
            $this->customerEntity->setUuid($uuid);
            return $this->customerEntity->getResponseDataId();

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
    }
}