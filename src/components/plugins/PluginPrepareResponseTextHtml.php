<?php
namespace df\components\plugins;

use extas\components\plugins\Plugin;
use extas\interfaces\parameters\IParameter;
use Psr\Http\Message\ResponseInterface;

/**
 * Class PluginPrepareResponseTextHtml
 *
 * @package df\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginPrepareResponseTextHtml extends Plugin
{
    /**
     * @param ResponseInterface $response
     * @param IParameter[] $responseParameters
     */
    public function __invoke(ResponseInterface &$response, $responseParameters)
    {
        $responseBody = '';
        $status = 200;

        foreach ($responseParameters as $parameter) {
            $stage = 'response.html.' . $parameter->getName();
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($responseBody, $status, $parameter->getValue());
            }
        }

        $response->withStatus($status)->getBody()->write($responseBody);
    }
}
