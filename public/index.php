<?php

/**
 * Front Controller.
 *
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

require_once '../vendor/autoload.php';

use Core\Request;
use Core\Router;
use Core\Dispatcher;
use Core\Error; 

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Router();
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{action}/{id:\d+}');

$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['QUERY_STRING']);

$dispatcher = new Dispatcher($router);
$dispatcher->handle($request);