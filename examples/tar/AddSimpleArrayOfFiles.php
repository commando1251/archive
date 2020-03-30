<?php
require __DIR__.'/vendor/autoload.php';

use Commando1251\Archive\ArchiveCreator;

try {
    $archive = new ArchiveCreator('test' . time() . '.tar');
    $data = [
        '/var/www/archive_test/pics/folder1/1.jpg',
        '/var/www/archive_test/pics/folder1/2.jpg'
    ];
    $archive->add($data)
        ->add($data, 'some_folder')
        ->build();
} catch (Exception $exception) {
    echo $exception->getMessage();
}