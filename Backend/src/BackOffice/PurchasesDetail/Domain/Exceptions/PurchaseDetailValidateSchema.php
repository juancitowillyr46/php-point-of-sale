<?php
namespace App\BackOffice\PurchasesDetail\Domain\Exceptions;

use App\Shared\Exception\ValidateRequestException;
use App\Shared\Exception\BaseValidatorRequest;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class PurchaseDetailValidateSchema extends BaseValidatorRequest
{
    public function getMessages(array $data): array {

        $messages = $this->createSchema([
            'id' => [
                new Optional()
            ],
            'purchaseId' => [
                new Required(),
            ],
            'productId' => [
                new Required(),
            ],
            'quantity' => [
                new Required(),
                new NotBlank(),
                new Type('integer'),
                new Positive()
            ],
            'price' => [
                new Required(),
            ],
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