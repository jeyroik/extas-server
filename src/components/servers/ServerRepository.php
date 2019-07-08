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
    protected $idAs = '';
    protected $scope = 'extas';
    protected $name = 'servers';
    protected $pk = Server::FIELD__NAME;
    protected $itemClass = Server::class;
}
