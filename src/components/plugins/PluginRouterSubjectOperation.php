<?php
namespace extas\components\plugins;

use extas\components\players\Current;
use extas\components\servers\requests\ServerRequest;
use extas\components\servers\responses\ServerResponse;
use extas\interfaces\IHasName;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\parameters\IParameter;
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
            IHasParameters::FIELD__PARAMETERS => $this->makeRequestParameters($request, $args),
            IHasName::FIELD__NAME =>  $section . '.' . $subject . '.' . $operation,
            IHasOwner::FIELD__OWNER => Current::player()->getName()
        ]);

        $serverResponse = new ServerResponse([
            IHasParameters::FIELD__PARAMETERS => $this->makeResponseParameters($response),
            IHasName::FIELD__NAME => $serverRequest->getName()
        ]);

        $this->dispatchRequest($serverRequest, $serverResponse, $section, $subject, $operation);
        $this->prepareResponse($request, $response, $serverResponse);
    }

    /**
     * @param $response
     *
     * @return array
     */
    protected function makeResponseParameters($response)
    {
        return [
            [
                IParameter::FIELD__NAME => ServerResponse::PARAMETER__HTTP_RESPONSE,
                IParameter::FIELD__VALUE => $response,
                IParameter::FIELD__TEMPLATE => ResponseInterface::class
            ]
        ];
    }

    /**
     * @param RequestInterface $request
     * @param $args
     *
     * @return array
     */
    protected function makeRequestParameters($request, $args)
    {
        parse_str($request->getUri()->getQuery(), $queryParams);
        $args = array_merge($args, $queryParams);
        $parameters = ServerRequest::makeParametersFrom($args, 'string');
        $parameters[] = [
            IParameter::FIELD__NAME => ServerRequest::PARAMETER__HTTP_REQUEST,
            IParameter::FIELD__VALUE => $request,
            IParameter::FIELD__TEMPLATE => RequestInterface::class
        ];

        return $parameters;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param IServerResponse $serverResponse
     */
    protected function prepareResponse(RequestInterface $request, ResponseInterface &$response, $serverResponse)
    {
        $responseParameters = $serverResponse->getParameters();
        $accepts = $this->getAccepts($request->getHeader('ACCEPT'));

        foreach ($accepts as $accept) {
            /**
             * application/xhtml
             * application/xhtml+xml
             * application/xhtml+xml;q=0.8
             * application/signed-exchange;v=b3
             */
            if (strpos($accept, ';') !== false) {
                list($accept) = explode(';', $accept);
            }
            $acceptAsKey = str_replace(['/', '+', '-'], '.', $accept);

            $stage = $acceptAsKey . '.prepare.response';
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($response, $responseParameters);
            }

            $stage .= '.' . $serverResponse->getName();
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($response, $responseParameters);
            }
        }
    }

    /**
     * @param $header
     *
     * @return array
     */
    protected function getAccepts($header)
    {
        $header = is_array($header) ? array_shift($header) : $header;

        return strpos($header, ',') !== false ? explode(',', $header) : [$header];
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
        $method = is_array($method) ? array_shift($method) : $method;

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
