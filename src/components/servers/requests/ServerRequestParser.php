<?php
namespace extas\components\servers\requests;

use extas\components\Item;
use extas\interfaces\servers\requests\IServerRequestParser;
use Psr\Http\Message\RequestInterface;

/**
 * Class ServerRequestParser
 *
 * @package extas\components\servers\requests
 * @author jeyroik@gmail.com
 */
class ServerRequestParser extends Item implements IServerRequestParser
{
    /**
     * @param RequestInterface $request
     *
     * @return IServerRequestParser
     */
    public function parse(RequestInterface $request): IServerRequestParser
    {
        $map = [
            static::FIELD__SECTION => $this->getSectionHeader(),
            static::FIELD__SUBJECT => $this->getSubjectHeader(),
            static::FIELD__OPERATION => $this->getOperationHeader(),
            static::FIELD__SERVER => $this->getServerHeader()
        ];

        foreach ($map as $field => $headerName) {
            $headers = $request->getHeader($headerName);
            if (count($headers)) {
                $this->config[$field] = array_shift($headers);
            }
        }

        return $this;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function getSection(string $default = ''): string
    {
        return $this->config[static::FIELD__SECTION] ?? $default;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function getSubject(string $default = ''): string
    {
        return $this->config[static::FIELD__SUBJECT] ?? $default;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function getOperation(string $default = ''): string
    {
        return $this->config[static::FIELD__OPERATION] ?? $default;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function getServer(string $default = ''): string
    {
        return $this->config[static::FIELD__SERVER] ?? $default;
    }

    /**
     * @return string
     */
    public function getSectionHeader(): string
    {
        return $this->config[static::FIELD__HEADER_SECTION] ?? '';
    }

    /**
     * @return string
     */
    public function getSubjectHeader(): string
    {
        return $this->config[static::FIELD__HEADER_SUBJECT] ?? '';
    }

    /**
     * @return string
     */
    public function getOperationHeader(): string
    {
        return $this->config[static::FIELD__HEADER_OPERATION] ?? '';
    }

    /**
     * @return string
     */
    public function getServerHeader(): string
    {
        return $this->config[static::FIELD__HEADER_SERVER] ?? '';
    }

    /**
     * @param string $section
     *
     * @return IServerRequestParser
     */
    public function setSection(string $section): IServerRequestParser
    {
        $this->config[static::FIELD__SECTION] = $section;

        return $this;
    }

    /**
     * @param string $subject
     *
     * @return IServerRequestParser
     */
    public function setSubject(string $subject): IServerRequestParser
    {
        $this->config[static::FIELD__SUBJECT] = $subject;

        return $this;
    }

    /**
     * @param string $operation
     *
     * @return IServerRequestParser
     */
    public function setOperation(string $operation): IServerRequestParser
    {
        $this->config[static::FIELD__OPERATION] = $operation;

        return $this;
    }

    /**
     * @param string $server
     *
     * @return IServerRequestParser
     */
    public function setServer(string $server): IServerRequestParser
    {
        $this->config[static::FIELD__SERVER] = $server;

        return $this;
    }

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setSectionHeader(string $headerName): IServerRequestParser
    {
        $this->config[static::FIELD__HEADER_SECTION] = $headerName;

        return $this;
    }

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setSubjectHeader(string $headerName): IServerRequestParser
    {
        $this->config[static::FIELD__HEADER_SUBJECT] = $headerName;

        return $this;
    }

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setOperationHeader(string $headerName): IServerRequestParser
    {
        $this->config[static::FIELD__HEADER_OPERATION] = $headerName;

        return $this;
    }

    /**
     * @param string $headerName
     *
     * @return IServerRequestParser
     */
    public function setServerHeader(string $headerName): IServerRequestParser
    {
        $this->config[static::FIELD__HEADER_SERVER] = $headerName;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}