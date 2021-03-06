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

        $group->group('/purchases', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Purchases\Application\Actions\PurchaseAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Purchases\Application\Actions\PurchaseFindAction::class);
            $group->get('', \App\BackOffice\Purchases\Application\Actions\PurchaseFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Purchases\Application\Actions\PurchaseEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Purchases\Application\Actions\PurchaseRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/purchases/{purchaseId}/detail', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Purchases\Application\Actions\Detail\PurchaseDetailAddAction::class);
            $group->put('/{id}', \App\BackOffice\Purchases\Application\Actions\Detail\PurchaseDetailEditAction::class);
            $group->get('/{id}', \App\BackOffice\Purchases\Application\Actions\Detail\PurchaseDetailFindAction::class);
            $group->get('', \App\BackOffice\Purchases\Application\Actions\Detail\PurchaseDetailFindAllAction::class);
            $group->delete('/{id}', \App\BackOffice\Purchases\Application\Actions\Detail\PurchaseDetailRemoveAction::class);
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

        $group->group('/permissions', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Permissions\Application\Actions\PermissionAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Permissions\Application\Actions\PermissionFindAction::class);
            $group->get('', \App\BackOffice\Permissions\Application\Actions\PermissionFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Permissions\Application\Actions\PermissionEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Permissions\Application\Actions\PermissionRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/providers', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Providers\Application\Actions\ProviderAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Providers\Application\Actions\ProviderFindAction::class);
            $group->get('', \App\BackOffice\Providers\Application\Actions\ProviderFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Providers\Application\Actions\ProviderEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Providers\Application\Actions\ProviderRemoveAction::class);
            $group->get('/{providerId}/products', \App\BackOffice\Products\Application\Actions\ProductCommonAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/customers', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Customers\Application\Actions\CustomerAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Customers\Application\Actions\CustomerFindAction::class);
            $group->get('', \App\BackOffice\Customers\Application\Actions\CustomerFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Customers\Application\Actions\CustomerEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Customers\Application\Actions\CustomerRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/sales', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Sales\Application\Actions\SaleAddAction::class);
            $group->get('/{uuid}', \App\BackOffice\Sales\Application\Actions\SaleFindAction::class);
            $group->get('', \App\BackOffice\Sales\Application\Actions\SaleFindAllAction::class);
            $group->put('/{uuid}', \App\BackOffice\Sales\Application\Actions\SaleEditAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Sales\Application\Actions\SaleRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/sales/{saleId}/detail', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Sales\Application\Actions\Detail\SaleDetailAddAction::class);
            $group->put('/{id}', \App\BackOffice\Sales\Application\Actions\Detail\SaleDetailEditAction::class);
            $group->get('/{id}', \App\BackOffice\Sales\Application\Actions\Detail\SaleDetailFindAction::class);
            $group->get('', \App\BackOffice\Sales\Application\Actions\Detail\SaleDetailFindAllAction::class);
            $group->delete('/{id}', \App\BackOffice\Sales\Application\Actions\Detail\SaleDetailRemoveAction::class);
        })->add(AuthValidateTokenMiddleware::class);

        $group->group('/commons', function (RouteCollectorProxy $group) {
            $group->get('/roles', \App\BackOffice\Roles\Application\Actions\RoleCommonAction::class);
            $group->get('/audit-status', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonAuditAction::class);
            $group->get('/blocked-user', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonBlockedAction::class);
            $group->get('/categories', \App\BackOffice\Categories\Application\Actions\CategoryCommonAction::class);
            $group->get('/providers', \App\BackOffice\Providers\Application\Actions\ProviderCommonAction::class);
            $group->get('/unit-measurement', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonUnitMeasurement::class);
            $group->get('/data-master-type', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonTypeAction::class);
            $group->get('/document-types', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonDocumentTypeAction::class);
            $group->get('/ubigeo/departments', \App\BackOffice\Ubigeo\Application\Actions\UbigeoCommonDepartment::class);
            $group->get('/ubigeo/departments/{department_id}/provinces', \App\BackOffice\Ubigeo\Application\Actions\UbigeoCommonProvince::class);
            $group->get('/ubigeo/departments/{department_id}/provinces/{province_id}/districts', \App\BackOffice\Ubigeo\Application\Actions\UbigeoCommonDistrict::class);
            $group->get('/type-tax-document', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonTypeTaxDocumentAction::class);
            $group->get('/status-purchase', \App\BackOffice\DataMaster\Application\Actions\DataMasterCommonStatusPurchaseAction::class);
        })->add(AuthValidateTokenMiddleware::class);

    });

};