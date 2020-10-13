<?php
namespace App\BackOffice\Customers\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class CustomerActionRequestSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'id' => [
                new Optional(),
            ],
            'firstName' => [
                new Required()
            ],
            'lastName' => [
                new Required()
            ],
            'documentNumber' => [
                new Required()
            ],
            'documentTypeId' => [
                new Required()
            ],
            'email' => [
                new Required()
            ],
            'businessName' => [
                new Required()
            ],
            'ruc' => [
                new Required()
            ],
            'homePhoneNumber' => [
                new Required()
            ],
            'cellPhoneNumber' => [
                new Required()
            ],
            'address' => [
                new Required()
            ],
            'departmentId' => [
                new Required(),
            ],
            'provinceId' => [
                new Required(),
            ],
            'districtId' => [
                new Required(),
            ],
            'active' => [
                new Type('bool')
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

        return $messages;
    }
}