<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Commando1251\Archive\ArchiveCreator;

class FrontController extends Controller
{
    /**
     * Use archive instance via dependency injection
     * @param ArchiveCreator $archive
     * @return void
     * @throws \Exception $
     */
    public function test(ArchiveCreator $archive)
    {
        $data = [
            '/var/www/archive_test/pics/folder2/3.jpg',
            '/var/www/archive_test/pics/folder2/4.jpg'
        ];

        $archive->setName('archive_' . time() . '.zip')
            ->init()
            ->add($data, 'report')
            ->build();
    }
}