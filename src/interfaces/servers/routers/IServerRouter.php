<?php
namespace extas\interfaces\servers\routers;

use extas\interfaces\plugins\IPlugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface IServerRouter
 *
 * @package extas\interfaces\servers\routers
 * @author jeyroik@gmail.com
 */
interface IServerRouter extends IPlugin
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return mixed
     */
    public function __invoke(RequestInterface &$request, ResponseInterface &$response, array &$args);
}
