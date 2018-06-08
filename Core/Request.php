<?php

namespace Core;

use Core\Contracts\RequestInterface;

/**
 * Class Request.
 *
 * @category Request
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
class Request implements RequestInterface
{
    /**
     * Request method.
     *
     * @var string
     */
    private $method;

    /**
     * Request url.
     *
     * @var string
     */
    private $url;

    /**
     * New Request instance.
     *
     * @param string $method
     * @param string $url
     */
    public function __construct(string $method, string $url)
    {
        $this->method = $method;
        $this->url = $url;
    }

    /**
     * Return HTTP method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Return url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
