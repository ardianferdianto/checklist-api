<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 31/08/19
 * Time: 20.56
 */

namespace Src\Application\Service\Authentication;


use Dingo\Api\Auth\Provider\Authorization;
use Dingo\Api\Routing\Route;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class StaticAuthentication extends Authorization
{
    public function authenticate(Request $request, Route $route)
    {
        $authHeader = $request->headers->get('authorization');
        $key = substr($authHeader, strpos($authHeader, ':') + 1);

        if ($key != env('APP_KEY', rand(0, 1000))) {
            throw new UnauthorizedHttpException('Static', 'Invalid authentication credentials.');
        }

        return true;
    }

    public function getAuthorizationMethod()
    {
        return 'authorization';
    }
}