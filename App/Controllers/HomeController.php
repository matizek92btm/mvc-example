<?php

namespace App\Controllers;

use Core\Abstracts\AbstractController;
use Core\View;

/**
 * HomeController
 *
 * @package Controller
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
class HomeController extends AbstractController
{   
    /**
     * Index page.
     *
     * @return void
     */
    public function index()
    {
        View::render('home');
    }
}
