<?php 

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AdminAIText extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AdminAIText';
    }
}