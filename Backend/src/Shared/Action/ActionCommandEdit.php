<?php
namespace App\Shared\Action;

use Exception;

abstract class ActionCommandEdit extends BaseActionCommand
{
    public function edit() {

        try {

            $uuid = $this->resolveArg('uuid');

            $formData = (array) $this->getFormData();

            $this->getValidator()->getMessages($formData);

            $payload = $this->getService()->payLoad($this->getFormData());

            return $this->getService()->edit($payload, $uuid);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }
}