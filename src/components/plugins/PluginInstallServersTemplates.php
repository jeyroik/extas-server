<?php
namespace extas\components\plugins;

use extas\components\servers\templates\ServerTemplate;
use extas\interfaces\servers\templates\IServerTemplateRepository;

/**
 * Class PluginInstallServersTemplates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallServersTemplates extends PluginInstallDefault
{
    protected string $selfItemClass = ServerTemplate::class;
    protected string $selfName = 'server template';
    protected string $selfSection = 'servers_templates';
    protected string $selfUID = ServerTemplate::FIELD__NAME;
    protected string $selfRepositoryClass = IServerTemplateRepository::class;
}
