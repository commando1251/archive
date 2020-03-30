<?php

namespace Commando1251\Archive\Interfaces;

interface DriverInterface
{
    /**
     * Create empty archive
     * @param string $fullPath
     * @param array $options
     * @return boolean
     */
    public function open($fullPath, $options = []);

    /**
     * Add file to archive
     * @param string $fullPath
     * @param (string|null) $alias
     * @return boolean
     */
    public function add($fullPath, $alias = null);

    /**
     * Add file to archive from from content
     * @param string $fileName
     * @param string $content
     * @return boolean
     */
    public function addFromString($fileName, $content);

    /**
     * Extract archive to destination
     * @param string $folder
     * @param array $files
     * @return boolean
     */
    public function extract($folder, array $files = []);

    /**
     * Complete and close archive
     * @return boolean
     */
    public function close();
}
