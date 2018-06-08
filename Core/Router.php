<?php

namespace Core;

use Core\Contracts\RequestInterface;
use Core\Contracts\RouterInterface;

/**
 * Class Router.
 *
 * @category Router
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
class Router implements RouterInterface
{

    /**
     * Router regular expression.
     *
     * @var array
     */
    protected $routers = [];

    /**
     * Param for Route.
     *
     * @var array
     */
    protected $params = [];

    /**
     * Add path to router with additional params.
     *
     * @param string $url
     * @param array $params
     * 
     * @return void
     */
    public function add(string $route, array $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\/', $route);

        // Convert variables to regular expression: exmplae {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?<\1>[a-z-]+)', $route);

        // Convert parameters to regular expression: example {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?<\1>\2)', $route);

        $route = '/^' . $route . '$/i';

        $this->routers[$route] = $params;
    }

    /**
     * Match request to router.
     *
     * @param Request $request
     * 
     * @return array|boolean
     */
    public function match(RequestInterface $request)
    {
        $url = $this->removeQueryStringVariables($request->getUrl());

        foreach ($this->routers as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $index => $val) {
                    if (is_string($index)) {
                        $params[$index] = $val;
                    }
                }
                return $this->params = $params;
            }
        }

        return false;
    }

    /**
     * Go to url. 
     *
     * @param string $page
     * @return void
     */
    public static function goto(string $page) 
    {
        header("Location: $page");
    }

    /**
     * Remove the query string variables from the URL (if any).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables(string $url)
    {
        if ($url !== "") {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], "=") === false) {
                $url = $parts[0];
            } else {
                $url = "";
            }
        }

        return $url;
    }
}
