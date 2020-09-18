<?php


namespace App\BackOffice\Users\Domain\Exceptions;


use Exception;

class DuplicateCodeException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Code product exist";
        parent::__construct($message, $code);
    }
}