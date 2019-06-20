<?php

namespace Pilabrem\DBLog\http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Pilabrem\DBLog\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Pilabrem\DBLog\Http\Facades\DBLog;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Log::paginate(15));
        $logs = Log::orderBy('logs.id', 'desc')
            ->join('users as u', 'logs.user_id', '=', 'u.id')
            ->paginate(5, ['logs.*', 'u.name as user_name']);

        return view('dblog::index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tableIndex($table, $id = 0)
    {
        $entite = null;
        if ($id != 0) {
            $logs = Log::where('table_name', $table)
                ->where('entity_id', $id)
                ->orderBy('logs.id', 'desc')
                ->join('users as u', 'logs.user_id', '=', 'u.id')
                ->paginate(5, ['logs.*', 'u.name as user_name']);

            $entite = DB::table($table)->find($id);
            if ($entite !== null) {
                foreach ($entite as $key => $value) {
                    if ($key != 'id') {
                        $entite = $value;
                        break;
                    }
                }
            }
        } else {
            $logs = Log::where('table_name', $table)
                ->orderBy('logs.id', 'desc')
                ->join('users as u', 'logs.user_id', '=', 'u.id')
                ->paginate(5, ['logs.*', 'u.name as user_name']);
        }

        return view('dblog::table-index', compact('table', 'logs', 'entite'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = Log::findOrFail($id);
        $entiteCourant = DB::table($log->table_name)->find($log->entity_id);
        $entite = json_decode($log->data);

        $datas = [];
        if (isset($entite)) {
            foreach ($entite as $key => $value) {
                if (isset($entiteCourant)) {
                    foreach ($entiteCourant as $key2 => $value2) {
                        if ($key == $key2) {
                            $datas [] = [$key, $value, $value2];
                            break;
                        }
                    }
                } else {
                    $datas [] = [$key, $value, null];
                }
            }
        } else {
            if (isset($entiteCourant)) {
                foreach ($entiteCourant as $key => $value) {
                    $datas [] = [$key, null, $value];
                }
            }
        }

        return view('dblog::show', compact('log', 'datas'));
    }
}
