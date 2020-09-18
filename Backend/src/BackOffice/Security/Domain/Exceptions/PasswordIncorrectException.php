<?php
namespace App\BackOffice\Security\Domain\Exceptions;

use Exception;

class PasswordIncorrectException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Password incorrect";
        parent::__construct($message, $code);
    }
}