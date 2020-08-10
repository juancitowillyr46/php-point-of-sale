<?php
namespace App\BackOffice\UsersType\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class UserTypeActionValidateSchema extends BaseValidatorRequest
{

    public array $data;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getMessages() {

        $messages = $this->createSchema([
            'uuid' => [
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
        ], $this->getData());

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages));
        }

        return $messages;
    }
}