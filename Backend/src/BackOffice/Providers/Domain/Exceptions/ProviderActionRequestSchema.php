<?php
namespace App\BackOffice\Providers\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class ProviderActionRequestSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'id' => [
                new Optional(),
            ],
            'name' => [
                new Required()
            ],
            'ruc' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
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
            'address' => [
                new Required()
            ],
            'description' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
            ],
            'homePhoneNumber' => [
                new Required()
            ],
            'cellPhoneNumber' => [
                new Required()
            ],
//            'representativeId' => [
//                new Required()
//            ],
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