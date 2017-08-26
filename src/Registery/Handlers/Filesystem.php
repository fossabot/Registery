<?php

namespace DALTCORE\Registery\Handlers;

class Filesystem
{
    /**
     * Filesystem constructor.
     */
    function __construct()
    {
        return $this;
    }

    /**
     * Return path to registery root
     *
     * @return string
     */
    public function path()
    {
        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'registery');

        if (file_exists($path) == false) {
            mkdir($path);
        }

        return $path;
    }
}
