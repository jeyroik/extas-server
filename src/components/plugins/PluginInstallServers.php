<?php
namespace extas\components\plugins;

use extas\components\servers\Server;
use extas\interfaces\servers\IServerRepository;

/**
 * Class PluginInstallServers
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallServers extends PluginInstallDefault
{
    protected $selfItemClass = Server::class;
    protected $selfName = 'server';
    protected $selfSection = 'servers';
    protected $selfUID = Server::FIELD__NAME;
    protected $selfRepositoryClass = IServerRepository::class;
}
