<?php

namespace Commando1251\Archive\Helpers;

use Exception;

class FileDownloader
{
    /**
     * Recursively convert directory to array with data
     * @param string $url
     * @return string $result
     * @throws Exception
     */
    public static function get($url)
    {
        $content = file_get_contents($url);
        if (!$content) {
            throw new Exception('Unable to download file ' . $url);
        }
        return $content;
    }
}