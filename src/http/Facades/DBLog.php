<?php

namespace Pilabrem\DBLog\Http\Facades;

use Illuminate\Support\Facades\Facade;
use Pilabrem\DBLog\Http\Classes\DBLog as DBLogClass;

class DBLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'classe.dblog';
    }
}