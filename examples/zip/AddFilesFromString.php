<?php
require __DIR__.'/vendor/autoload.php';

use Commando1251\Archive\ArchiveCreator;
try {
    $archive = new ArchiveCreator('my_test' . time() . '.zip');
    $archive->addFromString('test.txt', 'This is test file')
        ->addFromString('folder/info.txt', 'This is info file')
        ->build();
} catch (Exception $exception) {
    echo $exception->getMessage();
}