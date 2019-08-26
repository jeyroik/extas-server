<?php
namespace extas\interfaces\servers\responses;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\players\IHasOwner;

/**
 * Interface IServerResponse
 *
 * @package extas\interfaces\servers\responses
 * @author jeyroik@gmail.com
 */
interface IServerResponse extends IItem, IHasParameters, IHasOwner, IHasName, IHasDescription
{
    const SUBJECT = 'extas.server.response';
}
