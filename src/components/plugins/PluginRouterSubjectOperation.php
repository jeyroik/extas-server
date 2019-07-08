<?php
namespace extas\components\plugins;

use extas\interfaces\servers\routers\IServerRouter;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class PluginRouterSubjectOperation
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginRouterSubjectOperation extends Plugin implements IServerRouter
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
        $subject = $args['subject'] ?? 'app';
        $operation = $args['operation'] ?? 'index';

        $stageRunBefore = 'route.' . $subject . '.' . $operation . '.before';
        $stageRun = 'route.' . $subject . '.' . $operation;
        $stageRunAfter = 'route.' . $subject . '.' . $operation . '.after';

        foreach ($this->getPluginsByStage($stageRunBefore) as $plugin) {
            $plugin($request, $response, $args);
        }

        foreach ($this->getPluginsByStage($stageRun) as $plugin) {
            $plugin($request, $response, $args);
        }

        foreach ($this->getPluginsByStage($stageRunAfter) as $plugin) {
            $plugin($request, $response, $args);
        }
    }
}
