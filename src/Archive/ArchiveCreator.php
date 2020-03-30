<?php

namespace Commando1251\Archive;

use \Exception;
use Commando1251\Archive\DriverFactory;
use Commando1251\Archive\Interfaces\DriverInterface;
use Commando1251\Archive\Helpers\FileDownloader;

class ArchiveCreator
{
    /**
     * @var DriverInterface $driver
     */
    private $driver = null;

    /**
     * @var string $path
     */
    private $path = '';

    /**
     * @var string $name
     */
    private $name = '';

    /**
     * ArchiveCreator constructor.
     * @param string $name
     * @param string $path
     * @throws Exception
     */
    public function __construct($name = 'archive.zip', $path = '/tmp')
    {
        $this->setName($name);
        $this->setPath($path);
        $this->initDriver();
    }

    /**
     * Initializes the driver and creates empty archive
     * @return DriverInterface
     * @throws Exception
     */
    protected function initDriver()
    {
        if ($this->driver instanceof DriverInterface) {
            return $this->driver;
        }
        $this->driver = DriverFactory::get($this->getName());
        $this->driver->open($this->getArchiveLocation());
        return $this->driver;
    }

    /**
     * Init the driver based on name and path. Useful when unable to init driver in constructor
     * @return ArchiveCreator
     * @throws Exception
     */
    public function init()
    {
        $this->driver = DriverFactory::get($this->getName());
        $this->driver->open($this->getArchiveLocation());
        return $this;
    }

    /**
     * Getter method
     * @return DriverInterface
     */
    protected function getDriver()
    {
        return $this->driver;
    }

    /**
     * Adds new files to the archive based on data driver
     * @param (array|string) $data
     * @param string $folder
     * @param string $dataDriver
     * @return ArchiveCreator
     */
    public function add($data, $folder = '', $dataDriver = '')
    {
        if (empty($dataDriver)) {
            $dataDriver = is_array($data) ? 'Recursive' : 'Flat';
        }
        $dataDriver = '\Commando1251\Archive\DataDrivers\\' . $dataDriver;
        $dataDriver::setDriver($this->driver)->process($data, $folder);
        return $this;
    }

    /**
     * Add file to archive from from content
     * @param string $fileName
     * @param string $content
     * @return ArchiveCreator
     */
    public function addFromString($fileName, $content)
    {
        $this->driver->addFromString($fileName, $content);
        return $this;
    }

    /**
     * Add file to archive from from url
     * @param string $fileName
     * @param string $url
     * @return ArchiveCreator
     * @throws Exception $exception
     */
    public function addFromUrl($fileName, $url)
    {
        $content = FileDownloader::get($url);
        $this->driver->addFromString($fileName, $content);
        return $this;
    }

    /**
     * Extract archive to destination
     * @param string $folder
     * @param array $files
     * @return ArchiveCreator
     */
    public function extract($folder, $files = [])
    {
        $this->driver->extract($folder, $files);
        return $this;
    }
    

    /**
     * Gets archive name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets archive name
     * @param string $name
     * @return ArchiveCreator
     * @throws Exception
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new Exception('Name cannot be empty');
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets archive name
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets archive path
     * @param string $path
     * @return ArchiveCreator
     * @throws Exception
     */
    public function setPath($path)
    {
        if (empty($path)) {
            throw new Exception('Path cannot be empty');
        }
        $this->path = $path;
        return $this;
    }

    /**
     * Gets archive full path with name
     * @return string
     */
    public function getArchiveLocation()
    {
        return $this->getPath() . '/' . $this->getName();
    }

    /**
     * Compress archive with GZ
     * @return ArchiveCreator
     */
    public function compress()
    {
        $compress = $this->driver->compress();
        if ($compress) {
            $name = $this->getName();
            $name = str_replace('.tar', '.tar.gz', $name);
            $this->setName($name);
        }
        return $this;
    }

    /**
     * Builds archive and returns path. If set, moves it to specified destination
     * @param string $destination
     * @throws Exception
     * @return string
     */
    public function save($destination = '')
    {
        $this->getDriver()->close();
        if ($destination) {
            if (!copy($this->getArchiveLocation(), $destination)) {
                throw new Exception('Unable to copy file to ' . $destination, 500);
            }
            return $destination;
        }
        return $this->getArchiveLocation();
    }

    /**
     * Builds archive and sends it to user
     * @return void
     */
    public function build()
    {
        $this->getDriver()->close();
        $filename = $this->getArchiveLocation();
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($file_info, $filename);
        $name = basename($filename);
        header('Cache-Control: private, max-age=120, must-revalidate');
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // long ago
        header("Content-Type: $mimeType");
        header('Content-Disposition: attachment; filename="' . $name . '";');
        header("Accept-Ranges: bytes");
        header('Content-Length: ' . filesize($filename));
        print readfile($filename);
        exit;
    }
}