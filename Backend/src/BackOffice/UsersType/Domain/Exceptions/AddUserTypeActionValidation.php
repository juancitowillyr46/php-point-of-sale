<?php
namespace App\BackOffice\UsersType\Domain\Exceptions;

use App\Shared\Exception\ValidationRequest;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class AddUserTypeActionValidation extends ValidationRequest
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

        return $this->createSchema([
            'email' => [
                new Required(),
                new IsNull(),
                new NotBlank(),
                new Email()
            ],
            'username' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
            ],
            'password' => [
                new Required(),
                new Length([
                    'min' => 8
                ])
            ],
            'type_user' => [
                new Required(),
            ],
            'active' => [
                new Type('bool')
            ]
        ], $this->getData());
    }
}