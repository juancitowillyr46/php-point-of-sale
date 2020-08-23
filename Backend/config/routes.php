<?php
declare(strict_types=1);

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
        $group->group('/users', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Users\Application\Actions\AddUserAction::class);
            $group->put('/{uuid}', \App\BackOffice\Users\Application\Actions\EditUserAction::class);
            $group->get('/{uuid}', \App\BackOffice\Users\Application\Actions\FindUserAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Users\Application\Actions\RemoveUserAction::class);
            $group->get('', \App\BackOffice\Users\Application\Actions\FindUserAllAction::class);

        });
        $group->group('/users-type', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\UsersType\Application\Actions\AddUserTypeAction::class);
            $group->get('/{uuid}', \App\BackOffice\UsersType\Application\Actions\FindUserTypeAction::class);
            $group->get('', \App\BackOffice\UsersType\Application\Actions\FindAllUserTypeAction::class);
            $group->put('/{uuid}', \App\BackOffice\UsersType\Application\Actions\EditUserTypeAction::class);
            $group->delete('/{uuid}', \App\BackOffice\UsersType\Application\Actions\RemoveUserTypeAction::class);
        });
        $group->group('/categories', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Categories\Application\Actions\AddCategoryAction::class);
            $group->get('/{uuid}', \App\BackOffice\Categories\Application\Actions\FindCategoryAction::class);
            $group->get('', \App\BackOffice\Categories\Application\Actions\FindAllCategoryAction::class);
            $group->put('/{uuid}', \App\BackOffice\Categories\Application\Actions\EditCategoryAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Categories\Application\Actions\RemoveCategoryAction::class);
        });
        $group->group('/measure-units', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\MeasureUnits\Application\Actions\AddMeasureUnitAction::class);
            $group->get('/{uuid}', \App\BackOffice\MeasureUnits\Application\Actions\FindMeasureUnitAction::class);
            $group->get('', \App\BackOffice\MeasureUnits\Application\Actions\FindAllMeasureUnitAction::class);
            $group->put('/{uuid}', \App\BackOffice\MeasureUnits\Application\Actions\EditMeasureUnitAction::class);
            $group->delete('/{uuid}', \App\BackOffice\MeasureUnits\Application\Actions\RemoveMeasureUnitAction::class);
        });
        $group->group('/products', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Products\Application\Actions\AddProductAction::class);
            $group->get('/{uuid}', \App\BackOffice\Products\Application\Actions\FindProductAction::class);
            $group->get('', \App\BackOffice\Products\Application\Actions\FindAllProductAction::class);
            $group->put('/{uuid}', \App\BackOffice\Products\Application\Actions\EditProductAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Products\Application\Actions\RemoveProductAction::class);
        });
        $group->group('/purchases', function (RouteCollectorProxy $group) {
            $group->post('', \App\BackOffice\Purchases\Application\Actions\AddPurchaseAction::class);
            $group->get('/{uuid}', \App\BackOffice\Purchases\Application\Actions\FindPurchaseAction::class);
            $group->get('', \App\BackOffice\Purchases\Application\Actions\FindAllPurchaseAction::class);
            $group->put('/{uuid}', \App\BackOffice\Purchases\Application\Actions\EditPurchaseAction::class);
            $group->delete('/{uuid}', \App\BackOffice\Purchases\Application\Actions\RemovePurchaseAction::class);
            $group->get('/{uuidPurchase}/items', \App\BackOffice\PurchasesDetail\Application\Actions\FindAllDetailPurchaseDetailAction::class);
            $group->post('/{uuidPurchase}/items', \App\BackOffice\PurchasesDetail\Application\Actions\AddPurchaseDetailAction::class);
        });
    });

};