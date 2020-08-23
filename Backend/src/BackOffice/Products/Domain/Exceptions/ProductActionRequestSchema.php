<?php
namespace App\BackOffice\Products\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class ProductActionRequestSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'uuid' => [
                new Required(),
            ],
            'code' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
            ],
            'name' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
            ],
            'categoryUuid' => [
                new Required(),
                new Length([
                    'min' => 1,
                    'max' => 50
                ])
            ],
            'measureUnitUuid' => [
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
            /*'stock' => [
                new Required(),
                new NotBlank(),
                new Type('integer'),
                new PositiveOrZero()
            ],*/
            'active' => [
                new Type('bool')
            ],

        ], $data);

        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages, JSON_PRETTY_PRINT), 1500);
        }

        return $messages;
    }
}