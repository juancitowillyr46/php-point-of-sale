<?php


namespace App\Shared\Exception\Database;


use Exception;

class ExceptionEloquent extends Exception
{
    public function __construct($message = "", $code = 0)
    {
        $message = "Error interno";
        parent::__construct($message, $code);
    }
}