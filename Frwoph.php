<?php

/* Constants */
define('DS', DIRECTORY_SEPARATOR);
define('FRWOPH_ROOT', __DIR__);
define('FRWOPH_VENDORS', FRWOPH_ROOT . DS . 'Vendors');

/**
 * Pretty print_r
 * @param mixed $value
 * @param string $name
 */
function pr($value = array(), $name = 'default')
{
    echo ''
    . '<table border="1">'
    . '<tr><th><h3>' . $name . '</h3></th></tr>'
    . '<tr><td><pre>' . print_r($value, true) . '</pre></td></tr>'
    . '</table>';
}

/**
 * Autoload
 * @param string $classname
 */
function autoloader($classname)
{
    $file = '..' . DS . str_replace('\\', DS, $classname) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoloader');
