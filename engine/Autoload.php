<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $fileName = realpath(str_replace(['app', '\\'], ['..', DS], $className) . ".php");

        if (file_exists($fileName)) {
            include $fileName;

        }
    }
}