<?php
namespace App\Shared\Action;

use Exception;

abstract class ActionCommandRemove extends BaseActionCommand
{
    public function remove() {
        try {

            $uuid = $this->resolveArg('uuid');
            return $this->getService()->remove($uuid);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}