<?php
namespace extas\interfaces\servers;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\templates\IHasTemplate;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface IServer
 *
 * @package extas\interfaces\servers
 * @author jeyroik@gmail.com
 */
interface IServer extends IItem, IHasName, IHasDescription, IHasTemplate, IHasParameters
{
    const SUBJECT = 'extas.server';

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     */
    public function run(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface;
}
