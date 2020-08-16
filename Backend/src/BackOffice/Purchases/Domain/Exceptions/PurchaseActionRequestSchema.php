<?php
namespace App\BackOffice\Purchases\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class PurchaseActionRequestSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'uuid' => [
                new Required(),
            ],
            'documentTypeUuid' => [
                new Required(),
            ],
            'numDocument' => [
                new Required(),
            ],
            'serieDocument' => [
                new Required(),
            ],
            'providerUuid' => [
                new Required(),
            ],
            'statusUuid' => [
                new Required(),
            ],
            'date' => [
                new Required(),
            ],
            'total' => [
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