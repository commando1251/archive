<?php
require __DIR__.'/vendor/autoload.php';

use Commando1251\Archive\ArchiveCreator;
use Commando1251\Archive\Helpers\FolderToArrayTransformer;
try {
    $files = FolderToArrayTransformer::process('/var/www/archive_test/pics/');
    $archive = new ArchiveCreator('test' . time() . '.zip');
    $archive->add($files)
            ->build();
} catch (Exception $exception) {
    echo $exception->getMessage();
}