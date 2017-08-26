<?php

namespace DALTCORE\Registery\Handlers;

class Writer
{

    /**
     * Writer constructor.
     */
    public function __construct()
    {
        return $this;
    }

    public function save()
    {
        dd(storage_path('app/registery'));
    }
}
