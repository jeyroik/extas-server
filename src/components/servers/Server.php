<?php
namespace extas\components\servers;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\plugins\PluginRouterSubjectOperation;
use extas\components\SystemContainer;
use extas\components\templates\THasTemplate;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\servers\IServer;

use extas\interfaces\servers\routers\IServerRouter;
use extas\interfaces\servers\templates\IServerTemplateRepository;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Server
 *
 * @package extas\components\servers
 * @author jeyroik@gmail.com
 */
class Server extends Item implements IServer
{
    use THasName;
    use THasDescription;
    use THasTemplate;
    use THasParameters;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     */
    public function run(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $routerClass = $this->getParameter('router')->getValue(PluginRouterSubjectOperation::class);
        $map = $this->getParameter('operation.map')->getValue();
        $router = new $routerClass([IServerRouter::FIELD__OPERATION_MAP => $map]);
        $router($request, $response, $args);

        return $response;
    }

    /**
     * @return \extas\interfaces\repositories\IRepository|mixed
     */
    public function getTemplateRepository()
    {
        return SystemContainer::getItem(IServerTemplateRepository::class);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
