<?php


namespace App\BackOffice\Users\Application\Actions;


use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class FindUserAllAction extends UsersAction
{

    protected function action(): Response
    {
        try {

            $list = [];
            $all = $this->service->all([]);
            foreach($all as $item) {
                $list[] = $this->service->findToDto($item['uuid']);
            }
            return $this->respondWithData($list);

        } catch (Exception $e) {

            $error = new ActionError(ActionError::BAD_REQUEST, $e->getMessage());
            $payLoad = new ActionPayload(ActionPayload::STATUS_NOT_FOUND, null, $error);
            return $this->respond($payLoad);
        }
    }
}