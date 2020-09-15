<?php
namespace App\BackOffice\DataMaster\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class DataMasterActionRequestSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'id' => [
                new Optional(),
            ],
            'idRegister' => [
                new Required(),
            ],
            'type' => [
                new Required(),
            ],
            'name' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
            ],
            'description' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
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