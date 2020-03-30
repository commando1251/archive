<?php

namespace Commando1251\Archive;

use \Exception;

class DriverFactory
{
    /**
     * @param string $name
     * @return DriverInterface $dataDriver
     * @throws Exception
     */
    public static function get($name)
    {
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $extension = ucfirst(strtolower($extension));
        $dataDriver = '\Commando1251\Archive\Drivers\\' . $extension . 'Driver';
        if (class_exists($dataDriver) === false) {
            throw new Exception('Unable to load driver for ' . $extension . ' extension');
        }
        return new $dataDriver;
    }
}