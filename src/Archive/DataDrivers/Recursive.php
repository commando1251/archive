<?php

namespace Commando1251\Archive\DataDrivers;

use Commando1251\Archive\Interfaces\DataDriverInterface;
use Commando1251\Archive\Interfaces\DriverInterface;
use RecursiveIteratorIterator;
use RecursiveArrayIterator;

class Recursive implements DataDriverInterface
{
    /**
     * @var DriverInterface $driver
     */
    private static $driver;

    /**
     * Set archive driver to work with the data
     * @param DriverInterface $driver
     * @return Recursive
     */
    public static function setDriver(DriverInterface $driver)
    {
        self::$driver = $driver;
        return new self;
    }


    /**
     * Add data to archive
     * @param (array|string) $data
     * @param string $folder
     * @return void
     */
    public static function process($data, $folder = '')
    {
        $data = self::transformArrayToFlat($data);
        foreach ($data as $index => $file) {
            $index = preg_replace("/\d$/","", $index);
            if (!empty($folder)) {
                self::$driver->add($file, $folder . $index . basename($file));
            } else {
                self::$driver->add($file, $index  . basename($file));
            }
        }
    }

    /**
     * Transforms multidimensional array to flat list with paths as keys
     * @param array $array
     * @param string $path
     * @param array $holder
     * @return array
     */
    private static function transformArrayToFlat($array, $path = '', $holder = [])
    {
        if (is_array($array)) {
            foreach ($array as $index => $value) {
                $holder = self::transformArrayToFlat($value, sprintf('%s/%s', $path, $index), $holder);
            }
            return $holder;
        }
        $holder[$path] = $array;
        return $holder;
    }


}