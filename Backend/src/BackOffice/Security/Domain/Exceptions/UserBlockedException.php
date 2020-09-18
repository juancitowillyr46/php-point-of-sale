<?php
namespace App\BackOffice\Security\Domain\Exceptions;

use Exception;

class UserBlockedException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = "User Blocked";
        parent::__construct($message, $code);
    }
}