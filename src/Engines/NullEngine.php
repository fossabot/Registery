<?php

namespace DALTCORE\Registery\Engines;

use DALTCORE\Registery\Contracts\BaseEngine;

class NullEngine implements BaseEngine {

    protected $table = null;

    protected $data = [];

    /**
     * @param $array
     * @return $this
     */
    public function fill($array)
    {
        return $this;
    }

    /**
     * @param null $key
     * @return \Illuminate\Support\Collection|mixed|null
     */
    public function get($key = null)
    {
        return null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        //
    }

    /**
     * Save data object to disk
     */
    public function save()
    {
        //
    }

    /**
     * Get data object from disk
     */
    public function fetch()
    {
        return $this;
    }

    /**
     * Add table for this object
     *
     * @param $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;
    }
}