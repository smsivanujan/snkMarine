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
            ->get();

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
