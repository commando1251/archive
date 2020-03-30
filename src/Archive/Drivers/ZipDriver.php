<?php

namespace Commando1251\Archive\Drivers;

use Commando1251\Archive\Interfaces\DriverInterface;
use \ZipArchive;
use \Exception;

class ZipDriver implements DriverInterface
{
    private $driver;

    /**
     * ZipDriver constructor.
     */
    public function __construct()
    {
        $this->driver = new ZipArchive();
    }

    /**
     * Create empty zip archive
     * @param string $fullPath
     * @param array $options
     * @return boolean
     * @throws Exception
     */
    public function open($fullPath, $options = [])
    {
        if ($this->driver->open($fullPath, ZipArchive::CREATE) !== TRUE) {
            throw new Exception('Unable to init Zip Archive', 500);
        }
        return true;
    }

    /**
     * Add file to zip archive
     * @param string $fullPath
     * @param (string|null) $alias
     * @return boolean
     * @throws Exception
     */
    public function add($fullPath, $alias = null)
    {
        if (!is_file($fullPath)) {
            throw new Exception('File ' . $fullPath . ' not found');
        }
        return $this->driver->addFile($fullPath, $alias);
    }

    /**
     * Add file to archive from from content
     * @param string $fileName
     * @param string $content
     * @return boolean
     */
    public function addFromString($fileName, $content)
    {
        return $this->driver->addFromString($fileName, $content);
    }

    /**
     * Extract archive to destination
     * @param string $folder
     * @param array $files
     * @return boolean
     */
    public function extract($folder, array $files = [])
    {
        if (count($files) > 0) {
            return $this->driver->extractTo($folder, $files);
        } else {
            return $this->driver->extractTo($folder);
        }
    }

    /**
     * Complete and close zip archive
     * @return boolean
     */
    public function close()
    {
        return $this->driver->close();
    }
}