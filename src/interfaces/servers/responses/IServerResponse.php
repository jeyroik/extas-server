<?php
namespace extas\interfaces\servers\responses;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\players\IHasPlayer;

/**
 * Interface IServerResponse
 *
 * @package extas\interfaces\servers\responses
 * @author jeyroik@gmail.com
 */
interface IServerResponse extends IItem, IHasParameters, IHasPlayer, IHasName, IHasDescription
{
    const SUBJECT = 'extas.server.response';

    const PARAMETER__HTTP_RESPONSE = 'http_response';
}
