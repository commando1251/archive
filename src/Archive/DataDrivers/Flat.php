<?php

namespace Commando1251\Archive\DataDrivers;

use Commando1251\Archive\Interfaces\DataDriverInterface;
use Commando1251\Archive\Interfaces\DriverInterface;

class Flat implements DataDriverInterface
{
    /**
     * @var DriverInterface $driver
     */
    private static $driver;

    /**
     * Set archive driver to work with the data
     * @param DriverInterface $driver
     * @return Flat
     */
    public static function setDriver(DriverInterface $driver)
    {
        self::$driver = $driver;
        return new self;
    }

    /**
     * Add data to archive
     * @param string $file
     * @param string $folder
     * @return void
     */
    public static function process($file, $folder = '')
    {
        if (!empty($folder)) {
            self::$driver->add($file, $folder . '/' . basename($file));
        } else {
            self::$driver->add($file, basename($file));
        }
    }
}