<?php
namespace extas\components\protocols;

/**
 * Class ProtocolServer
 *
 * Парсит параметры и заголовки запроса на предмет наличия server'a.
 * Дефолтное значение можно переопределить через переменную окружения EXTAS__PROTOCOL_SERVER__DEFAULT.
 * Префикс заголовка можно переопределить через переменную окружения EXTAS__PROTOCOL_SERVER__HEADER_PREFIX.
 *
 * @package extas\components\protocols
 * @author jeyroik@gmail.com
 */
class ProtocolServer extends ProtocolParameterHeaderDefault
{
    protected string $protocolKey = 'server';
}
