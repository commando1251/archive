<?php
require __DIR__.'/vendor/autoload.php';

use Commando1251\Archive\ArchiveCreator;

try {
    $archive = new ArchiveCreator('test' . time() . '.tar');
    $archive->add('/var/www/archive_test/pics/folder1/1.jpg')
        ->add('/var/www/archive_test/pics/folder1/2.jpg', 'test_folder')
        ->compress()
        ->build();
} catch (Exception $exception) {
    echo $exception->getMessage();
}