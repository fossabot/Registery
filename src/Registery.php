<?php

namespace DALTCORE\Registery;

use DALTCORE\Registery\Exception\BadMethodCallException;
use DALTCORE\Registery\Registery\Handler;

class Registery
{
    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws \DALTCORE\Registery\Exception\BadMethodCallException
     */
    public static function __callStatic($name, $arguments)
    {
        if (Registery::instance() == null) {
            Registery::$instance = new Handler();
        }

        if (!method_exists(Registery::instance(), $name)) {
            throw new BadMethodCallException('Method \'' . $name . '\'does not exist in ' . get_class(Registery::instance()));
        }

        return call_user_func_array([Registery::instance(), $name], $arguments);
    }

    /**
     * Instance handler for the Registery
     *
     * @return null|Handler
     */
    protected static function instance()
    {
        return Registery::$instance;
    }
}
