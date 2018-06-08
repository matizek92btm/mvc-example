<?php

namespace Core\Contracts;

/**
 * Interface for Request. 
 * 
 * @category Contracts
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

interface RequestInterface {

    /**
     * Return HTTP Method.
     *
     * @return string
     */
    public function getMethod();

    /**
     * Return url.
     *
     * @return string
     */
    public function getUrl();
}