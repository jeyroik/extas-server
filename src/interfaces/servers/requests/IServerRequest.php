<?php
namespace extas\interfaces\servers\requests;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHasParameters;
use extas\interfaces\players\IHasOwner;

/**
 * Interface IServerRequest
 *
 * @package extas\interfaces\servers\requests
 * @author jeyroik@gmail.com
 */
interface IServerRequest extends IItem, IHasName, IHasDescription, IHasOwner, IHasParameters
{
    const SUBJECT = 'extas.server.request';

    const PARAMETER__HTTP_REQUEST = 'http_request';
    const PARAMETER__EXPAND = 'expand';

    /**
     * @param $array
     *
     * @return array
     */
    public static function makeParametersFrom($array): array;

    /**
     * @return string[]
     */
    public function getExpand(): array;

    /**
     * @param string $expand
     *
     * @return bool
     */
    public function isExpandedWith($expand): bool;
}
