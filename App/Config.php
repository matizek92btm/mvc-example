<?php

namespace App;

/**
 * Config Class.
 *
 * @package Config
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

class Config
{
    /**
     * Database host.
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database user.
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password.
     * @var string
     */
    const DB_PASSWD = 'root';

    /**
     * Database table name.
     * @var string
     */
    const DB_NAME = 'mvc';

    /**
     * Show error on screen
     * @var boolean
     */
    const SHOW_ERROR =  true;
}
