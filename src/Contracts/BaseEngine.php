<?php

namespace DALTCORE\Registery\Contracts;

interface BaseEngine
{

    /**
     * Fill selected table with these data
     *
     * @param $array
     *
     * @return mixed
     */
    public function fill($array);

    /**
     * Fill and save
     *
     * @param $array
     *
     * @return mixed
     */
    public function update($array);

    /**
     * Selecte database from model contents or default model name pluralized
     *
     * @param $table
     *
     * @return mixed
     */
    public function table($table);

    /**
     * Save entry(s) to database
     *
     * @return mixed
     */
    public function save();

    /**
     * Get entries from driver and put in object
     */
    public function fetch();

    /**
     * Get one or more entries from data object
     *
     * @return mixed
     */
    public function get($key = null);

    /**
     * Set new parameter to data object
     *
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function set($name, $value);
}
