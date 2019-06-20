<?php

namespace Pilabrem\DBLog\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'entity_id',
        'table_name',
        'data',
        'ip',
        'user_agent',
        'location',
        'action',
        'message',
    ];
}
