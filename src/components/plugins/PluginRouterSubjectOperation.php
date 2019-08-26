<?php
namespace extas\components\plugins;

use extas\components\players\Current;
use extas\components\servers\requests\ServerRequest;
use extas\components\servers\responses\ServerResponse;
use extas\interfaces\IHasName;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\players\IHasOwner;
use extas\interfaces\servers\requests\IServerRequest;
use extas\interfaces\servers\responses\IServerResponse;
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
        $section = $args['section'] ?? 'app';
        $subject = $args['subject'] ?? 'index';
        $operation = $this->convertMethodToOperation($request->getHeader('REQUEST_METHOD'));

        $serverRequest = new ServerRequest([
            IHasParameters::FIELD__PARAMETERS => ServerRequest::makeParametersFrom($args, 'string'),
            IHasName::FIELD__NAME =>  $section . '.' . $subject . '.' . $operation,
            IHasOwner::FIELD__OWNER => Current::player()->getName()
        ]);

        $serverResponse = new ServerResponse([
            IHasName::FIELD__NAME => $serverRequest->getName() . '.response'
        ]);

        $this->dispatchRequest($serverRequest, $serverResponse, $section, $subject, $operation);
        $this->prepareResponse($request, $response, $serverResponse);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param IServerResponse $serverResponse
     */
    protected function prepareResponse(RequestInterface $request, ResponseInterface &$response, $serverResponse)
    {
        $responseParameters = $serverResponse->getParameters();
        $accept = $request->getHeader('ACCEPT');
        $acceptAsKey = str_replace('/', '.', $accept);

        $stage = $serverResponse->getName() . '.' . $acceptAsKey;
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($response, $responseParameters);
        }
    }

    /**
     * @param IServerRequest $serverRequest
     * @param IServerResponse $serverResponse
     * @param string $section
     * @param string $subject
     * @param string $operation
     */
    protected function dispatchRequest(&$serverRequest, &$serverResponse, $section, $subject, $operation)
    {
        $stageRunBefore = 'route.' . $section . '.' . $subject . '.' . $operation . '.before';
        $stageRun = 'route.' . $section . '.' .  $subject . '.' . $operation;
        $stageRunAfter = 'route.' . $section . '.' .  $subject . '.' . $operation . '.after';

        foreach ($this->getPluginsByStage('route.before') as $plugin) {
            $plugin($serverRequest, $serverResponse);
        }

        foreach ($this->getPluginsByStage($stageRunBefore) as $plugin) {
            $plugin($serverRequest, $serverResponse);
        }

        foreach ($this->getPluginsByStage($stageRun) as $plugin) {
            $plugin($serverRequest, $serverResponse);
        }

        foreach ($this->getPluginsByStage($stageRunAfter) as $plugin) {
            $plugin($serverRequest, $serverResponse);
        }

        foreach ($this->getPluginsByStage('route.after') as $plugin) {
            $plugin($serverRequest, $serverResponse);
        }
    }

    /**
     * @param $method
     *
     * @return string
     */
    protected function convertMethodToOperation($method)
    {
        $map = [
            'get' => 'view',
            'put' => 'update',
            'post' => 'create',
            'delete' => 'delete',
            '@default' => 'view'
        ];

        return $map[$method] ?? $map['@default'];
    }
}
