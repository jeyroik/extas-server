<?php
namespace extas\components\servers;

use extas\components\Item;
use extas\components\SystemContainer;
use extas\interfaces\servers\IServer;
use extas\interfaces\servers\IServerRepository;
use extas\interfaces\servers\IServerRunner;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ServerRunner
 *
 * @package extas\components\servers
 * @author jeyroik@gmail.com
 */
class ServerRunner extends Item implements IServerRunner
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     */
    public static function run(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        /**
         * @var $serverRepo IServerRepository
         * @var $servers IServer[]
         */
        $serverRepo = SystemContainer::getItem(IServerRepository::class);
        $servers = $serverRepo->all([IServer::FIELD__TEMPLATE => $args['server']]);

        foreach ($servers as $server) {
            $response = $server->run($request, $response, $args);
        }

        return $response;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
