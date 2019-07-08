<?php
namespace extas\components\servers\templates;

use extas\components\repositories\Repository;
use extas\interfaces\servers\templates\IServerTemplateRepository;

/**
 * Class ServerTemplateRepository
 *
 * @package extas\components\servers\templates
 * @author jeyroik@gmail.com
 */
class ServerTemplateRepository extends Repository implements IServerTemplateRepository
{
    protected $itemClass = ServerTemplate::class;
    protected $pk = ServerTemplate::FIELD__NAME;
    protected $name = 'servers_templates';
    protected $scope = 'extas';
    protected $idAs = '';
}
