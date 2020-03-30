<?php

namespace Commando1251\Archive\Interfaces;

interface DataDriverInterface
{
    /**
     * Set archive driver to work with the data
     * @param DriverInterface $driver
     */
    public static function setDriver(DriverInterface $driver);

    /**
     * Add data to archive
     * @param (array|string) $data
     * @param string $folder
     */
    public static function process($data, $folder = '');
}
