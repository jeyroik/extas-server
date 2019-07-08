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
    protected $selfItemClass = ServerTemplate::class;
    protected $selfName = 'server template';
    protected $selfSection = 'servers_templates';
    protected $selfUID = ServerTemplate::FIELD__NAME;
    protected $selfRepositoryClass = IServerTemplateRepository::class;
}
