<?php
namespace extas\components\servers;

use extas\components\repositories\Repository;
use extas\interfaces\servers\IServerRepository;

/**
 * Class ServerRepository
 *
 * @package extas\components\servers
 * @author jeyroik@gmail.com
 */
class ServerRepository extends Repository implements IServerRepository
{
    protected string $idAs = '';
    protected string $scope = 'extas';
    protected string $name = 'servers';
    protected string $pk = Server::FIELD__NAME;
    protected string $itemClass = Server::class;
}
