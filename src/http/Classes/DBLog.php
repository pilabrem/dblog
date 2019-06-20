<?php

namespace Pilabrem\DBLog\Http\Classes;

use Illuminate\Http\Request;
use Pilabrem\DBLog\Models\Log;
use Illuminate\Support\Facades\Auth;

class DBLog
{
    /**
     * @param string $entity
     * @param string $action (create|read|update|delete)
     * @param string $message
     * @param Request $request
     */
    public function log ($entity, $action, $message, Request $request) {
        // Valeur par défaut désignant localhost
        $location = "Ouagadougou, Burkina Faso";
        $loc = geoip();

        if (isset($loc->city)) {
            $location = $loc->city . ", " .$loc->country;
        }
        
        $log = new Log();
        $log->user_id = Auth::id();
        $log->entity_id = $entity->id;
        $log->table_name = $entity->getTable();
        $log->data = $entity->toJson();
        $log->ip = $request->ip();
        $log->user_agent = $request->userAgent();
        $log->location = $location;
        $log->action = $action;
        $log->message = $message;
        $log->save();
        return true;
    }
}