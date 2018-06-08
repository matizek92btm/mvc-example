<?php

namespace Core\Abstracts;

use Core\Exceptions\BadMethodCallException;

/**
 * Abstract Controller.
 *
 * @package Abstract
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
abstract class AbstractController
{

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * 
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }
}
