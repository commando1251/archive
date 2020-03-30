<?php
require __DIR__.'/vendor/autoload.php';

use Commando1251\Archive\ArchiveCreator;

try {
    $archive = new ArchiveCreator('test' . time() . '.zip');
    $data = [
        'root' => [
            'folder1' => [
                '/var/www/archive_test/pics/folder1/1.jpg',
                '/var/www/archive_test/pics/folder1/2.jpg'
            ],
            'folder2' => [
                '/var/www/archive_test/pics/folder2/3.jpg',
                '/var/www/archive_test/pics/folder2/4.jpg'
            ]
        ],
        'user' => [
            '/var/www/archive_test/pics/folder2/3.jpg',
            '/var/www/archive_test/pics/folder2/4.jpg'
        ]
    ];

    $archive->add($data, 'report_folder');
    $archive->build();
} catch (Exception $exception) {
    echo $exception->getMessage();
}