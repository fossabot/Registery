<?php

namespace DALTCORE\Registery;

use DALTCORE\Registery\Exception\BadMethodCallException;
use DALTCORE\Registery\Exception\DataIntegrityException;
use DALTCORE\Registery\Registery\Handler;
use Illuminate\Support\Pluralizer;

class Registery extends Handler
{

    protected $callableObjects = [
        'find', 'fill', 'save', 'delete', 'get', 'update'
    ];

    /**
     * Registery constructor.
     */
    public function __construct()
    {
        parent::$instance = parent::__construct();

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws \DALTCORE\Registery\Exception\BadMethodCallException
     */
    public static function __callStatic($name, $arguments)
    {
        // This wil boot the Handler
        $class = get_called_class();
        $me = get_class(new $class); // Referrers to nothing

        // Magic table handling
        if (parent::$instance->table === null) {
            parent::$instance->setTable(Pluralizer::plural(parent::$instance->prefix . class_basename($class)));
        } else {
            parent::$instance->setTable(parent::$instance->table);
        }

        // Fetch data from database
        try {
            parent::$instance->fetchData();
        } catch (\Exception $e) {
            if ($e instanceof DataIntegrityException) {
                throw new DataIntegrityException($e->getMessage());
            }
        }

        // The static way for "get" gets interpreted as object
        if ($name == 'get') {
            $name = 'object';
        }

        // Execute command to Handler class
        if (!method_exists(parent::$instance, 'call' . camel_case($name))) {
            throw new BadMethodCallException('Method \'' . 'call' . camel_case($name) . '\' does not exist in ' . class_basename($class));
        }

        // Return execution results
        return call_user_func_array([parent::$instance, 'call' . camel_case($name)], $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {

        $class = get_called_class();

        // Execute command to Handler class
        if (!method_exists(parent::$instance, 'call' . camel_case($name))) {
            throw new BadMethodCallException('Method \'' . 'call' . camel_case(ucfirst($name)) . '\' does not exist in ' . ($class));
        }

        return call_user_func_array([parent::$instance, 'call' . camel_case($name)], $arguments);
    }

}
