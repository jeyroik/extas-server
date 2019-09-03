<?php
namespace extas\components\plugins;

use extas\interfaces\servers\requests\IServerRequest;
use extas\interfaces\servers\responses\IServerResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class PluginRouteAppIndex
 *
 * Stage example: route.app.index.view
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginRouteAppIndexRun extends Plugin
{
    /**
     * @param IServerRequest $request
     * @param IServerResponse $response
     *
     * @return mixed|void
     */
    public function __invoke(IServerRequest &$request, IServerResponse &$response)
    {
        $responseMessage = 'It works! Welcome to Extas Server v0.0.1';

        /**
         * @var $httpResponse ResponseInterface
         */
        $httpResponse = $response->getParameter(IServerResponse::PARAMETER__HTTP_RESPONSE)->getValue();
        if ($httpResponse && $httpResponse->hasHeader('ACCEPT')) {
            $accept = $httpResponse->getHeader('ACCEPT');
            if (strpos($accept, 'text') === false) {
                $responseMessage = 'Please, send ACCEPT header with "text/html" to see result';
            }
        }

        $response->setParameter('app', [
            'name' => getenv('EXTAS__APP_NAME') ?: 'extas',
            'title' => getenv('EXTAS__APP_TITLE') ?: 'Extas application',
            'description' => getenv('EXTAS__APP_NAME') ?: 'Default app/index/view dispatcher',
            'copyright' => '2019-' . date('Y') . ' jeyroik@gmail.com',
            'content' => $responseMessage,
            'expand' => ['version']
        ]);
    }
}
