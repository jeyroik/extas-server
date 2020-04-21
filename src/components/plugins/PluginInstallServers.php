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
    protected string $selfItemClass = Server::class;
    protected string $selfName = 'server';
    protected string $selfSection = 'servers';
    protected string $selfUID = Server::FIELD__NAME;
    protected string $selfRepositoryClass = IServerRepository::class;
}
