<?php
namespace extas\components\servers\responses;

use extas\components\Item;
use extas\components\parameters\THasParameters;
use extas\components\players\THasOwner;
use extas\components\THasDescription;
use extas\components\THasName;
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
    use THasOwner;
    use THasParameters;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
