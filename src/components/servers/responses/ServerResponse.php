<?php
namespace extas\components\servers\responses;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\players\THasPlayer;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\parameters\IParameter;
use extas\interfaces\servers\responses\IServerResponse;

/**
 * Class ServerResponse
 *
 * @package extas\components\servers\responses
 * @author jeyroik@gmail.com
 */
class ServerResponse extends Item implements IServerResponse
{
    use THasName;
    use THasDescription;
    use THasPlayer;
    use THasParameters;

    /**
     * @param $array
     * @param string $defaultTemplate
     *
     * @return array
     */
    public static function makeParametersFrom($array, $defaultTemplate = 'string'): array
    {
        $parameters = [];

        foreach ($array as $name => $value) {
            $parameters[] = [
                IParameter::FIELD__NAME => $name,
                IParameter::FIELD__VALUE => $value,
                IParameter::FIELD__TEMPLATE => $defaultTemplate
            ];
        }

        return $parameters;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
