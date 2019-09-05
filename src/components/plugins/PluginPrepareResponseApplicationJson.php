<?php
namespace extas\components\plugins;

use extas\interfaces\parameters\IParameter;
use Psr\Http\Message\ResponseInterface;

/**
 * Class PluginPrepareResponseApplicationJson
 *
 * @package df\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginPrepareResponseApplicationJson extends Plugin
{
    /**
     * @param ResponseInterface $response
     * @param IParameter[] $responseParameters
     */
    public function __invoke(ResponseInterface &$response, $responseParameters)
    {
        $responseBody = [];
        $status = 200;

        foreach ($responseParameters as $parameter) {
            $responseBody[$parameter->getName()] = $parameter->getValue();
        }

        /**
         * with* methods return a copy of a response, because Response is immutable
         */
        $response = $response->withHeader('Content-Type', 'application/json')->withStatus($status);
        $response->getBody()->write(json_encode($responseBody));
    }
}
