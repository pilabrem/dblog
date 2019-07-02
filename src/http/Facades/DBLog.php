<?php

namespace Pilabrem\DBLog\Http\Facades;

use Illuminate\Support\Facades\Facade;

class DBLog extends Facade
{
    public static $CREATE = "create";

    protected static function getFacadeAccessor()
    {
        return 'classe.dblog';
    }
}
