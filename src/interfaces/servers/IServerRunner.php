<?php
namespace extas\interfaces\servers;

use extas\interfaces\IItem;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface IServerRunner
 *
 * @package extas\interfaces\servers
 * @author jeyroik@gmail.com
 */
interface IServerRunner extends IItem
{
    const SUBJECT = 'extas.server.runner';

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     */
    public static function run(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface;
}
