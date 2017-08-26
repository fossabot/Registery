<?php

namespace DALTCORE\Registery\Engines;

use DALTCORE\Registery\Contracts\BaseEngine;
use File;

class JsonEngine implements BaseEngine {

    protected $table = null;

    protected $data = [];

    protected $originalData = [];

    /**
     * @param $array
     * @return $this
     */
    public function fill($array)
    {
        $this->data = $array;
        return $this;
    }

    /**
     * @param null $key
     * @return \Illuminate\Support\Collection|mixed|null
     */
    public function get($key = null)
    {

        if($key === null)
        {
            return $this->data;
        }

        if(isset($this->data[$key]))
        {
            return $this->data[$key];
        }

        return null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Save data object to disk
     */
    public function save()
    {
        $header = [
            'integrity' => sha1(implode('-', $this->data)),
            'elements' => count($this->data),
            'lock' => false,
        ];


        $writer = [
            'meta' => $header,
            'data' => $this->data
        ];

        $json = json_encode($writer);


        if (!File::exists(storage_path('Registery'))) {
            File::makeDirectory(storage_path('Registery'), 0755, true);
        }

        file_put_contents(storage_path('Registery' . DIRECTORY_SEPARATOR . $this->table . '.json'), $json);
    }

    /**
     * Get data object from disk
     */
    public function fetch()
    {
        if (!File::exists(storage_path('Registery' . DIRECTORY_SEPARATOR . $this->table . '.json'))) {
            $this->data = null;
        }

        $json = storage_path('Registery' . DIRECTORY_SEPARATOR . $this->table . '.json');
        $array = json_decode(file_get_contents($json), TRUE);
        $this->fill($array['data']);
        $this->originalData = $array['data'];

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