<?php
use extas\interfaces\servers\IServerRepository as IRepo;
use extas\interfaces\servers\IServer;
use extas\components\SystemContainer as Container;

/**
 * @var $request \Psr\Http\Message\RequestInterface
 * @var $response \Psr\Http\Message\ResponseInterface
 * @var $args array
 *
 * @return \Psr\Http\Message\ResponseInterface
 */
return function ($request, $response, $args) {
    /**
     * @var $serverRepo \extas\interfaces\servers\IServerRepository
     * @var $servers \extas\interfaces\servers\IServer[]
     */
    $serverRepo = Container::getItem(IRepo::class);
    $servers = $serverRepo->all([IServer::FIELD__TEMPLATE => 'http.base']);

    foreach ($servers as $server) {
        $response = $server->run($request, $response, $args);
    }

    return $response;
};
