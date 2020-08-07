<?php
namespace App\Shared\Exception;

use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class ValidationRequest
{
    public ValidatorInterface $validator;

    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    public function createSchema($options, $data): array {

        $constraint = new Collection($options);

        $groups = new GroupSequence(['Default', 'custom']);

        $messages = [];

        $validations = $this->validator->validate((array) $data, $constraint, $groups);

        if(count($validations) > 0) {
            foreach($validations as $validation) {
                $messages[] = $validation->getPropertyPath() .": ".$validation->getMessage();
            }
        }

        return $messages;
    }

    public function validateRequest($messages): ?ActionPayload {
        if(count($messages) > 0) {
            throw new ValidateRequestException(json_encode($messages));
        }
        return null;
    }

}