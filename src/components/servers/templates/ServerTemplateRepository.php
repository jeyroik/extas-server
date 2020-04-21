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
    protected string $itemClass = ServerTemplate::class;
    protected string $pk = ServerTemplate::FIELD__NAME;
    protected string $name = 'servers_templates';
    protected string $scope = 'extas';
    protected string $idAs = '';
}
