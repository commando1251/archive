<?php

namespace Commando1251\Archive\Drivers;

use Commando1251\Archive\Interfaces\DriverInterface;
use Commando1251\Archive\Interfaces\CompressDataInterface;
use \PharData;
use \Phar;
use \Exception;

class TarDriver implements DriverInterface, CompressDataInterface
{
    private $driver;

    /**
     * TarDriver constructor.
     */
    public function __construct()
    {

    }

    /**
     * Create empty tar archive
     * @param string $fullPath
     * @param array $options
     * @return boolean
     * @throws Exception
     */
    public function open($fullPath, $options = [])
    {
        $this->driver = new PharData($fullPath, Phar::CURRENT_AS_FILEINFO | Phar::KEY_AS_FILENAME);
        if ($this->driver instanceof PharData === false) {
            throw new Exception('Unable to init Tar Archive', 500);
        }
        return true;
    }

    /**
     * Add file to zip archive
     * @param string $fullPath
     * @param string $alias
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
     * No need for the tar driver
     * @return void
     */
    public function close()
    {

    }

    /**
     * Compress archive with GZ
     * @return boolean
     */
    public function compress()
    {
        return $this->driver->compress(Phar::GZ);
    }
}