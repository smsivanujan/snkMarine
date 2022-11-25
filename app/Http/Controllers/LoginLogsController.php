<?php

namespace App\Http\Controllers;

use App\Models\login_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginLogsController extends Controller
{
    public function index()
    {
        $loginlogs = DB::table('login_logs')
            ->select(
                'login_logs.id',
                'login_logs.date',
                'login_logs.user_id',
                'login_logs.ipaddress',
                'login_logs.browser',
                'login_logs.os',
                'login_logs.user_agent',
                'login_logs.login_type',
                'login_logs.login_time',
                'users.client_id',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('users', 'login_logs.user_id', '=', 'users.id')
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->paginate(50);

        return $loginlogs;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $loginlogs = DB::table('login_logs')
            ->select(
                'login_logs.id',
                'login_logs.date',
                'login_logs.user_id',
                'login_logs.ipaddress',
                'login_logs.browser',
                'login_logs.os',
                'login_logs.user_agent',
                'login_logs.login_type',
                'login_logs.login_time',
                'users.client_id',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('users', 'login_logs.user_id', '=', 'users.id')
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->where('clients.id', '=', $id)
            ->get();

        return $loginlogs;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $loginlogs = DB::table('login_logs')
            ->select(
                'login_logs.id',
                'login_logs.date',
                'login_logs.user_id',
                'login_logs.ipaddress',
                'login_logs.browser',
                'login_logs.os',
                'login_logs.user_agent',
                'login_logs.login_type',
                'login_logs.login_time',
                'users.client_id',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('users', 'login_logs.user_id', '=', 'users.id')
            ->join('clients', 'users.client_id', '=', 'clients.id')
                ->where(function ($q) use ($query) {
                    $q->where('login_logs.date', 'like', '%' . $query . '%')
                        ->orWhere('login_logs.login_type', 'like', '%' . $query . '%')
                        ->orWhere('login_logs.login_time', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $loginlogs;
    }

    public function showByFilter(Request $request)
    {
        $fdate = isset($request->fdate) ? $request->fdate : date('Y-m-d');
        $tdate = isset($request->tdate) ? $request->tdate : date('Y-m-d');

        $loginlogs = DB::table('login_logs')
            ->select(
                'login_logs.id',
                'login_logs.date',
                'login_logs.user_id',
                'login_logs.ipaddress',
                'login_logs.browser',
                'login_logs.os',
                'login_logs.user_agent',
                'login_logs.login_type',
                'login_logs.login_time',
                'users.client_id',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('users', 'login_logs.user_id', '=', 'users.id')
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->where(DB::raw('DATE_FORMAT(login_logs.date, "%Y-%m-%d")'), '>=', $fdate)
            ->where(DB::raw('DATE_FORMAT(login_logs.date, "%Y-%m-%d")'), '<=', $tdate);

        if (!empty($request->user_id) && !empty($request->client_id)) {

             $loginlogs = $loginlogs
             ->where('login_logs.user_id', '=', $request->user_id)
             ->where('users.client_id', '=', $request->client_id);
        }
        elseif (!empty($request->user_id) && empty($request->client_id)) {

            $loginlogs = $loginlogs
            ->where('login_logs.user_id', '=', $request->user_id);
        }
        elseif (empty($request->user_id) && !empty($request->client_id)) {

            $loginlogs = $loginlogs
            ->where('users.client_id', '=', $request->client_id);
        }
        else
        {
            $loginlogs = $loginlogs;
        }

        $result = $loginlogs->orderBy('login_logs.id')
            ->get();
        return $result;
    }

    public function store(Request $request)
    {
        $loginlog = new login_logs();

        try {
            $loginlog->date = $request->date;
            $loginlog->user_id = $request->user_id;
            $loginlog->ipaddress = $request->ipaddress;
            $loginlog->browser = $request->browser;
            $loginlog->os = $request->os;
            $loginlog->user_agent = $request->user_agent;
            $loginlog->login_type = $request->login_type;
            $loginlog->login_time = $request->login_time;
            $loginlog->save();

            $data = [
                'is_create' => true,
                'error' => []
            ];

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }
}
