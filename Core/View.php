<?php

namespace Core;

use Core\Contracts\ViewInterface;
use \Twig_Environment;
use \Twig_Loader_Filesystem;

/**
 * View class.
 *
 * @package Core
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
class View implements ViewInterface
{
    /**
     * Render view.
     *
     * @param string $template
     * @param array $args
     *
     * @return void
     */
    public static function render(string $template, array $params = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new Twig_Loader_Filesystem('../resources/views');
            $twig = new Twig_Environment($loader);
        }

        echo $twig->render($template . '.html', $params);
    }
}
