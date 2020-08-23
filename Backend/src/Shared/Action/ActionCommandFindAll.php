<?php
namespace App\Shared\Action;

use Exception;

abstract class ActionCommandFindAll extends BaseActionCommand
{
    public function findAll() {

        try {

            $list = [];
            $all = $this->service->all([]);
            foreach($all as $item) {
                $list[] = $this->service->findToDto($item['uuid']);
            }
            return $list;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

}