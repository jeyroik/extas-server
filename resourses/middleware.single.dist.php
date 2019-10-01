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
     * @var $server \extas\interfaces\servers\IServer
     */
    $serverRepo = Container::getItem(IRepo::class);
    $server = $serverRepo->one([IServer::FIELD__NAME => 'http_base']);

    if ($server) {
        return $server->run($request, $response, $args);
    }

    return $response;
};
