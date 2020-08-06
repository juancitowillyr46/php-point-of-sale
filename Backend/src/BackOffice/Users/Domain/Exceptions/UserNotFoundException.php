<?php
namespace App\BackOffice\Users\Domain\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "El usuario no fue encontrado";
        parent::__construct($message, $code);
    }
}