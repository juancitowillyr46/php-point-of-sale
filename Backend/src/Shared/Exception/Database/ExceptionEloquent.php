<?php


namespace App\Shared\Exception\Database;


use Exception;

class ExceptionEloquent extends Exception
{
    public function __construct($message = "", $code = 0)
    {
        $message = "Existe un problema en la transacción, verifique que los datos sean correctos";
        parent::__construct($message, $code);
    }
}