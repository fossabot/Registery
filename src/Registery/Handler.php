<?php

namespace DALTCORE\Registery\Registery;

use DALTCORE\Registery\Exception\EngineNotFoundException;
use DALTCORE\Registery\Registery;

class Handler
{

    /**
     * Instance
     *
     * @var Handler|null
     */
    protected static $instance = null;

    /**
     * Available DB engines
     */
    const JSONDB = '\\DALTCORE\\Registery\\Engines\\JsonEngine';
    const MEMORYDB = '\\DALTCORE\\Registery\\Engines\\MemoryEngine';
    const NULLDB = '\\DALTCORE\\Registery\\Engines\\NullEngine';

    /**
     * Table prefix
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Default DB engine
     *
     * @var string
     */
    protected $engine = Registery::JSONDB;

    /**
     * @var null
     */
    protected $table = null;

    /**
     * Handler constructor.
     */
    public function __construct()
    {
        // Check if we're already instantiated
        if(self::$instance !== null)
        {
            return $this;
        }

        self::$instance = $this;

        $this->engine = $this->startEngine();

        return $this;
    }

    /**
     * Couple selected engine to the engine parameter
     *
     * @return mixed
     * @throws EngineNotFoundException
     */
    private function startEngine()
    {
        $class = $this->engine;

        if(class_exists($class))
        {
            $engine = (new $class);
            return $engine;
        } else {
            throw new EngineNotFoundException('Engine driver ' . $this->engine . ' is not found!');
        }
    }

    /**
     * Set table on self and engine
     *
     * @param $table
     * @return $this
     */
    protected function setTable($table)
    {
        $this->table = $table;

        if(is_string($this->engine))
        {
            $this->engine = $this->startEngine();
        }

        $this->engine->table($table);

        return $this;
    }

    /**
     * Fetch data from driver
     *
     * @return $this
     */
    protected function fetchData()
    {
        $this->engine->fetch();
        return $this;
    }

    /**
     * Callable finder
     *
     * @return string
     */
    public function callFind()
    {
        return $this;
    }

    /**
     * Handle input to object
     *
     * @param array $input
     *
     * @return object
     */
    public function callFill(array $input)
    {
        $this->engine->fill($input);
        return $this;
    }

    /**
     * Save the contents
     */
    public function callSave()
    {
        $this->engine->save();
        return $this;
    }

    /**
     * Get all contents in object
     * @param null $name
     * @return mixed
     */
    public function callGet($name = null)
    {
        return self::$instance->engine->get($name);
    }

    /**
     * Cet object
     *
     * @return Handler|null
     */
    public function callObject()
    {
        return self::$instance;
    }

    /**
     * Object to json
     *
     * @return string
     */
    public function callToJson()
    {
        return json_encode($this->callGet());
    }

    /**
     * Whole classed object to PHP Serialized object
     *
     * @return string
     */
    public function callToSerialize()
    {
        return serialize($this);
    }

    /**
     * Get element from object
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->callGet($name);
    }

    /**
     * Set element to object
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->engine->set($name, $value);
    }
}
