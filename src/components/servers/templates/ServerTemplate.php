<?php
namespace extas\components\servers\templates;

use extas\components\templates\Template;
use extas\components\templates\THasTemplate;
use extas\interfaces\servers\templates\IServerTemplate;

/**
 * Class ServerTemplate
 *
 * @package extas\components\servers\templates
 * @author jeyroik@gmail.com
 */
class ServerTemplate extends Template implements IServerTemplate
{
    use THasTemplate;
}
