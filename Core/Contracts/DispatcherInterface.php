<?php

namespace Core\Contracts;

/**
 * Interface for Dispatcher. 
 * 
 * @category Contracts
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

interface DispatcherInterface {

    /**
     * Get resource for request.
     * 
     * @param RequestInterface $request.
     * @return string
     */
    public function handle(RequestInterface $request);
}