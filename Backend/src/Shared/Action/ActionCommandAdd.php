<?php
namespace App\Shared\Action;

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
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

}