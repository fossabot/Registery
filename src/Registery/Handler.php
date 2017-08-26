<?php

namespace DALTCORE\Registery\Registery;

class Handler
{
    /**
     * Handler constructor.
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @return array
     */
    public function find()
    {
        return func_get_args();
    }

    /**
     *
     */
    public function save()
    {
        dd($this->path());
    }
}
