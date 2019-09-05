<?php
namespace extas\components\servers\requests;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\players\THasOwner;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\parameters\IParameter;
use extas\interfaces\servers\requests\IServerRequest;

/**
 * Class ServerRequest
 *
 * @package extas\components\servers\requests
 * @author jeyroik@gmail.com
 */
class ServerRequest extends Item implements IServerRequest
{
    use THasOwner;
    use THasName;
    use THasDescription;
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
     * @return string[]
     */
    public function getExpand(): array
    {
        $expand = $this->getParameter(static::PARAMETER__EXPAND, null);

        return $expand ? explode(',', str_replace(' ', '', $expand->getValue())) : [];
    }

    /**
     * @param string $expand
     *
     * @return bool
     */
    public function isExpandedWith($expand): bool
    {
        $expands = $this->getExpand();

        return in_array($expand, $expands);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
