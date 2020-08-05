<?php


namespace App\Shared\Middleware;


use App\Shared\Action\ActionError;
use App\Shared\Action\ActionPayload;
use App\Shared\Utility\JwtCustom;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;

class AuthValidateTokenMiddleware implements MiddlewareInterface
{
    private JwtCustom $jwtCustom;
    private ResponseFactory $responseFactory;


    public function __construct(JwtCustom $jwtCustom, ResponseFactory $responseFactory)
    {
        $this->jwtCustom = $jwtCustom;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        try {

            if(!$request->getHeaderLine('Authorization')) {
                throw new Exception("No se encontró el token de seguridad");
            }

            $authorization = explode(' ', (string)$request->getHeaderLine('Authorization'));

            if(count($authorization) == 1) {
                throw new Exception("Existe el token pero no cumple con el formato");
            }

            $token = $authorization[1] ?? '';

//            $verify = $this->jwtCustom->decodeToken($token);
//
//            // Append valid token
//            $request = $request->withAttribute('token', $verify->sub);
//
//            // Append the user id as request attribute
//            $request = $request->withAttribute('uid', $verify->sub);

        } catch (Exception $ex) {

            $response = $this->responseFactory->createResponse();
            $error = new ActionError(ActionError::UNAUTHENTICATED, $ex->getMessage());
            $actionPayload = new ActionPayload(ActionPayload::STATUS_UNAUTHORIZED, null, $error);
            $response->getBody()->write(json_encode($actionPayload));
            return $response
                            ->withStatus(ActionPayload::STATUS_UNAUTHORIZED)
                            ->withHeader('Content-Type', 'application/json');

        }

        return $handler->handle($request);
    }
}