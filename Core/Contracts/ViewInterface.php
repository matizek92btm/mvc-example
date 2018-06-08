<?php

namespace Core\Contracts;

/**
 * Interface for View. 
 * 
 * @category Contracts
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

interface ViewInterface {

    /**
     * Render view. 
     *
     * @param string $template
     * @param array $args
     * 
     * @return void
     */
    public static function render(string $template, array $args = []);
}