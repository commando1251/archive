<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Commando1251\Archive\Laravel\Facades\Archive;

class FrontController extends Controller
{

    /**
     * User archive instance via Facade
     * @return void
     * @throws \Exception $
     */
    public function test()
    {
        Archive::setName('archive2_' . time() . '.tar')
            ->init()
            ->add('/var/www/archive_test/pics/folder1/1.jpg')
            ->add('/var/www/archive_test/pics/folder1/2.jpg', 'test_folder')
            ->build();
    }
}