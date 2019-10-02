<?php
namespace extas\interfaces\servers\requests;

use extas\interfaces\IItem;
use Psr\Http\Message\RequestInterface;

/**
 * Interface IServerRequestParser
 *
 * @package extas\interfaces\servers\requests
 * @author jeyroik@gmail.com
 */
interface IServerRequestParser extends IItem
{
    const SUBJECT = 'extas.server.parser';

    const FIELD__HEADER_SECTION = 'header_section';
    const FIELD__HEADER_SUBJECT = 'header_subject';
    const FIELD__HEADER_OPERATION = 'header_operation';
    const FIELD__HEADER_SERVER = 'header_server';

    const FIELD__SECTION = 'section';
    const FIELD__SUBJECT = 'subject';
    const FIELD__OPERATION = 'operation';
    const FIELD__SERVER = 'server';

    /**
     * @param RequestInterface $request
     *
     * @return IServerRequestParser
     */
    public function parse(RequestInterface $request): IServerRequestParser;

    /**
     * @param string $section
     *
     * @return IServerRequestParser
     */
    public function setSection(string $section): IServerRequestParser;

    /**
     * @param string $subject
     *
     * @return IServerRequestParser
     */
    public function setSubject(string $subject): IServerRequestParser;

    /**
     * @param string $operation
     *
     * @return IServerRequestParser
     */
    public function setOperation(string $operation): IServerRequestParser;

    /**
     * @param string $server
     *
     * @return IServerRequestParser
     */
    public function setServer(string $server): IServerRequestParser;

    /**
     * @param string $default
     *
     * @return string
     */
    public function getSection(string $default = ''): string;

    /**
     * @param string $default
     *
     * @return string
     */
    public function getSubject(string $default = ''): string;

    /**
     * @param string $default
     *
     * @return string
     */
    public function getOperation(string $default = ''): string;

    /**
     * @param string $default
     *
     * @return string
     */
    public function getServer(string $default = ''): string;

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setSectionHeader(string $headerName): IServerRequestParser;

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setSubjectHeader(string $headerName): IServerRequestParser;

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setOperationHeader(string $headerName): IServerRequestParser;

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setServerHeader(string $headerName): IServerRequestParser;

    /**
     * @return string
     */
    public function getSectionHeader(): string;

    /**
     * @return string
     */
    public function getSubjectHeader(): string;

    /**
     * @return string
     */
    public function getOperationHeader(): string;

    /**
     * @return string
     */
    public function getServerHeader(): string;
}
