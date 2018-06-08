<?php

namespace Core;

use Core\Abstracts\AbstractController;
use Core\Contracts\DispatcherInterface;
use Core\Contracts\RequestInterface;
use Core\Contracts\RouterInterface;
use Core\Exceptions\ControllerException;
use Core\Exceptions\NoRouteException;
use Core\Exceptions\NotEnoughParamException;
use \ReflectionMethod;

/**
 * Class Dispatcher.
 *
 * @category Dispatcher
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
class Dispatcher implements DispatcherInterface
{

    /**
     * Instance of Router.
     *
     * @var Router
     */
    private $router;

    /**
     * New instance of Dispatcher.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Get resource for request.
     *
     * @param RequestInterface $request.
     * 
     * @return void
     * 
     * @throws ControllerException
     * @throws NoRouteException
     */
    public function handle(RequestInterface $request)
    {
        $handle = $this->router->match($request);
        if ($handle) {
            $controllerName = $this->convertToStudlyCaps($handle['controller']) . 'Controller';
            $namespace = $this->getNamespace($handle);
            $controller = $namespace . $controllerName;

            if (class_exists($controller)) {
                //@todo Reflection for Controller DI?
                $controllerObject = new $controller();

                $action = $this->convertToCamelCase($handle['action']);
                if (is_callable([$controllerObject, $action])) {
                    $this->callMethod($controllerObject, $action, $handle);
                }
            } else {
                throw new ControllerException('Controller not found', 404);
            }
        } else {
            throw new NoRouteException('Route not found', 404);
        }

    }

    /**
     * Get namespace for controller.
     *
     * @param array $handle
     * 
     * @return string
     */
    protected function getNamespace($handle)
    {

        if (isset($handle['additional']['namespace'])) {
            return $handle['additional']['namespace'] . '\\';
        }

        return 'App\Controllers\\';
    }

    /**
     * Convert string to studly caps.
     *
     * @param string $string
     * 
     * @return string
     */
    protected function convertToStudlyCaps(string $string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert string to camel case.
     *
     * @param string $string
     * 
     * @return string
     */
    protected function convertToCamelCase(string $string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * Call method by using ReflectionMethod.
     *
     * @param Controller $controllerObject
     * @param string $action
     * @param array $handle
     *
     * @return void
     * 
     * @throws NotEnoughParamException
     */
    protected function callMethod(AbstractController $controllerObject, string $action, array $handle)
    {
        $handle = $this->clearHandleArray($handle, ['action', 'controller', 'additional']);

        $reflectionMethod = new ReflectionMethod($controllerObject, $action);
        if ($reflectionMethod->getNumberOfParameters() > 0) {
            $params = $this->prepareParams($handle);
            if (!$params) {
                throw new NotEnoughParamException('Params missing.', 500);
            }
            $reflectionMethod->invoke($controllerObject, $params);
        } else {
            $reflectionMethod->invoke($controllerObject);
        }
    }

    /**
     * Remove from array uneccessery information.
     *
     * @param array $handle
     * @param array $clears
     * 
     * @return array
     */
    protected function clearHandleArray(array $handle, array $clears = [])
    {
        foreach ($clears as $clear) {
            unset($handle[$clear]);
        }

        return $handle;
    }

    /**
     * Prepare params for call function.
     *
     * @param array $handle
     * 
     * @return string|boolean
     */
    protected function prepareParams(array $handle)
    {
        $parameters = null;
        foreach ($handle as $requestParam) {

            $parameters .= is_numeric($requestParam) ? $requestParam . ',' : "'$requestParam',";
        }

        if ($parameters === null) {
            return false;
        }

        return rtrim($parameters, ',');
    }

}
