<?php

namespace Commando1251\Archive\Helpers;
use IteratorIterator;
use DirectoryIterator;

class FolderToArrayTransformer
{
    /**
     * Recursively convert directory to array with data
     * @param string $path
     * @param int $depth
     * @return array $result
     */
    public static function process($path, $depth = 0)
    {
        $iterator = new IteratorIterator(new DirectoryIterator($path));
        $result = [];
        foreach ($iterator as $splFileInfo) {
            if ($splFileInfo->isDot()) {
                continue;
            }
            $info = str_replace('\\', '/', $splFileInfo->getPathname());
            if ($splFileInfo->isDir()) {
                $nodes = self::process($splFileInfo->getPathname(), $depth + 1);
                if (!empty($nodes)) {
                    $info = $nodes;
                }
            }
            if ($splFileInfo->isDir()) {
                $result[$splFileInfo->getFilename()] = $info;
            } else {
                $result[] = $info;
            }
        }
        return $result;
    }
}