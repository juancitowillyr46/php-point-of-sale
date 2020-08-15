<?php
namespace App\Shared\Action;

use App\Shared\Exception\Database\ExceptionEloquent;
use Exception;

abstract class ActionCommandAdd extends BaseActionCommand
{
    public function add() {

        try {

            $formData = (array) $this->getFormData();

            $this->getValidator()->getMessages($formData);

            $payload = $this->getService()->payLoad($this->getFormData());

            return $this->getService()->add($payload);

        } catch (Exception $e) {
            $message = $e->getMessage();
            if($e->getCode() == '23000'){
                throw new ExceptionEloquent($message, $e->getCode());
            }
            throw new Exception($message, $e->getCode());
        }

    }

}