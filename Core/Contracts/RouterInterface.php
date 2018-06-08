<?php

namespace Core\Contracts;

/**
 * Interface for Router. 
 * 
 * @category Contracts
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

interface RouterInterface {

    /**
     * Add path to router with additional params. 
     *
     * @param string $url
     * @param array $params
     * @return void
     */
    public function add(string $url, array $params = []);

    /**
     * Match request to router. 
     *
     * @param RequestInterface $request
     * @return array
     */
    public function match(RequestInterface $request);


    /**
     * Go to url.
     * 
     * @param string $page.
     * 
     * @return void
     */
    public static function goTo(string $page);
}