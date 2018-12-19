<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 12/19/18
 * Time: 10:32 PM
 */

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DisableCacheMiddleware
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $response = $next($request, $response);
        $response = $response->withDisabledCache();
        return $response;
    }
}