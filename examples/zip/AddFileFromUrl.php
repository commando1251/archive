<?php
require __DIR__.'/vendor/autoload.php';

use Commando1251\Archive\ArchiveCreator;
try {
    $archive = new ArchiveCreator('my_test' . time() . '.zip');
    $archive->addFromUrl('folder/picture.jpg', 'http://www.sirajalilm.com/wp-content/uploads/2019/12/slide_the-1.jpg');
    $archive->build();
} catch (Exception $exception) {
    echo $exception->getMessage();
}