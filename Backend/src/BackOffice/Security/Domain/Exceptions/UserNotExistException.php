<?php
namespace App\BackOffice\Security\Domain\Exceptions;

use Exception;

class UserNotExistException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "Username not exist";
        parent::__construct($message, $code);
    }
}