<?php

namespace App\Controllers;

use App\Models\User;
use Core\Abstracts\AbstractController;
use Core\Router;
use Core\View;

/**
 * User Controller.
 *
 * @package Controller
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
class UserController extends AbstractController
{
    /**
     * Shows all users.
     *
     * @return void
     */
    public function all()
    {
        View::render('users/all', [
            'users' => User::all(),
        ]);
    }
}
