<?php
require __DIR__.'/vendor/autoload.php';

use Commando1251\Archive\ArchiveCreator;
try {
    //create test archive
    $archive = new ArchiveCreator('my_test' . time() . '.zip');
    $archive->add('/var/www/archive_test/pics/folder1/1.jpg')
        ->add('/var/www/archive_test/pics/folder1/2.jpg', 'test_folder')
        ->save();
    $name = $archive->getName();
    //open created archive
    $archive = new ArchiveCreator($name, '/tmp');
    //extract all archive to some folder
    $archive->extract('/var/www/archive_test/test1');
    //extract only one file to another folder
    $archive->extract('/var/www/archive_test/test2', ['test_folder/2.jpg']);
    $archive = $archive->save();

} catch (Exception $exception) {
    echo $exception->getMessage();
}