<?php
declare(strict_types=1);

use App\Shared\Middleware\AuthValidateTokenMiddleware;
use Slim\App;
//use Slim\Http\Response;
//use Slim\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\BackOffice\Home\Application\Actions\HelloWorldAction;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', HelloWorldAction::class);

    $app->group('/api', function (RouteCollectorProxy $group) {

        $group->group('/security', function (RouteCollectorProxy $group) {
            $group->post('/login', \App\BackOffice\Security\Application\Actions\LoginAction::class);
            $group->get('/me', \App\BackOffice\Users\Application\Actions\UserInfoAction::class)->add(AuthValidateTokenMiddleware::class);
        });

        $group->group('/users', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Users\Application\Actions\UserAddAction::class);
            $group->put('/{uuid}', \App\BackOffice\Users\Application\Actions\UserEditAction::class);
            $group->get('/{uuid}', \App\BackOffice\Users\Application\Actions\UserFindAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Users\Application\Actions\UserRemoveAction::class);
            $group->get('', \App\BackOffice\Users\Application\Actions\UserFindAllAction::class);

        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/categories', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Categories\Application\Actions\CategoryAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Categories\Application\Actions\CategoryFindAction::class);
            $group->get('', \App\BackOffice\Categories\Application\Actions\CategoryFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Categories\Application\Actions\CategoryEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Categories\Application\Actions\CategoryRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/products', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Products\Application\Actions\ProductAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Products\Application\Actions\ProductFindAction::class);
            $group->get('', \App\BackOffice\Products\Application\Actions\ProductFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Products\Application\Actions\ProductEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Products\Application\Actions\ProductRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/persons', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Persons\Application\Actions\PersonAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Persons\Application\Actions\PersonFindAction::class);
            $group->get('', \App\BackOffice\Persons\Application\Actions\PersonFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Persons\Application\Actions\PersonEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Persons\Application\Actions\PersonRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/purchases', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Purchases\Application\Actions\PurchaseAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Purchases\Application\Actions\PurchaseFindAction::class);
            $group->get('', \App\BackOffice\Purchases\Application\Actions\PurchaseFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Purchases\Application\Actions\PurchaseEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Purchases\Application\Actions\PurchaseRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/purchases/{purchaseId}/items', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\PurchasesDetail\Application\Actions\PurchaseDetailAddAction::class);
            $group->get('/{id}', \App\BackOffice\PurchasesDetail\Application\Actions\PurchaseDetailFindAction::class);
            $group->get('', \App\BackOffice\PurchasesDetail\Application\Actions\PurchaseDetailFindAllAction::class);
            $group->put('/{id}', \App\BackOffice\PurchasesDetail\Application\Actions\PurchaseDetailEditAction::class);
            $group->delete('/{id}', \App\BackOffice\PurchasesDetail\Application\Actions\PurchaseDetailRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/data-master', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\DataMaster\Application\Actions\DataMasterAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\DataMaster\Application\Actions\DataMasterFindAction::class);
            $group->get('', \App\BackOffice\DataMaster\Application\Actions\DataMasterFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\DataMaster\Application\Actions\DataMasterEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\DataMaster\Application\Actions\DataMasterRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/roles', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Roles\Application\Actions\RoleAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Roles\Application\Actions\RoleFindAction::class);
            $group->get('', \App\BackOffice\Roles\Application\Actions\RoleFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Roles\Application\Actions\RoleEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Roles\Application\Actions\RoleRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/commons', function (RouteCollectorProxy $group) {
            $group->get('/roles', \App\BackOffice\Roles\Application\Actions\RoleCommonAction::class);
            $group->get('/audit-status', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonAuditAction::class);
            $group->get('/blocked-user', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonBlockedAction::class);
        })->add(AuthValidateTokenMiddleware::class);

    });

};