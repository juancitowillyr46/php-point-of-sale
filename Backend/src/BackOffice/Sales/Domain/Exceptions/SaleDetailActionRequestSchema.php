<?php
namespace App\BackOffice\Sales\Domain\Exceptions;

use App\Shared\Exception\BaseValidatorRequest;
use App\Shared\Exception\ValidateRequestException;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class SaleDetailActionRequestSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'id' => [
                new Optional(),
            ],
            'saleId' => [
                new Required(),
            ],
            'productId' => [
                new Required(),
            ],
            'quantity' => [
                new Required(),
            ],
            'price' => [
                new Required(),
            ],
            'subtotal' => [
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