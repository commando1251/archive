<?php

namespace Commando1251\Archive\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Archive extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'archive';
    }
}