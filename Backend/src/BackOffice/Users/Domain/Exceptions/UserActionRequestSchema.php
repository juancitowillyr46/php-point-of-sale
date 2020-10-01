<?php
namespace App\BackOffice\Users\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class UserActionRequestSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'id' => [
               new Optional(),
            ],
            'email' => [
                new Email(),
                new Required(),
                new Length([
                    'min' => 4,
                    'max' => 50
                ])
            ],
            'username' => [
                new Required(),
                new Length([
                    'min' => 4,
                    'max' => 50
                ])
            ],
            'password' => [
                new Required(),
                new Length([
                    'min' => 8
                ])
            ],
            'roleId' => [
                new Required(),
            ],
            'active' => [
                new Type('bool')
            ],
            'blocked' => [
                new Type('bool')
            ],
            'firstName' => [
                new Required(),
                new Length([
                    'min' => 4,
                    'max' => 50
                ])
            ],
            'lastName' => [
                new Required(),
                new Length([
                    'min' => 4,
                    'max' => 50
                ])
            ]
        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

        return $messages;
    }
}