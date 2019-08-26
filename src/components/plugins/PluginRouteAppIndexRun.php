<?php
namespace extas\components\plugins;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class PluginRouteAppIndex
 *
 * Stage example: route.app.index.view
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginRouteAppIndexRun extends Plugin
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return mixed|void
     */
    public function __invoke(RequestInterface &$request, ResponseInterface &$response, array &$args)
    {
        $responseMessage = 'It works! Welcome to Extas Server v0.0.1';

        if ($response->hasHeader('ACCEPT')) {
            $accept = $response->getHeader('ACCEPT');
            if (strpos($accept, 'text') === false) {
                $responseMessage = 'Please, send ACCEPT header with "text/html" to see result';
            }
        }

        $response->getBody()->write($responseMessage);
    }
}
