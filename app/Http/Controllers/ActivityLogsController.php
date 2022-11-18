<?php

namespace App\Http\Controllers;

use App\Models\activity_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ActivityLogsController extends Controller
{
    public function index()
    {
        $activitylogs = DB::table('activity_logs')
            ->select(
                'activity_logs.id',
                'activity_logs.date',
                'activity_logs.user_id',
                'activity_logs.action',
                'users.client_id',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('users', 'activity_logs.user_id', '=', 'users.id')
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->paginate(50);

        return $activitylogs;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $activitylogs = DB::table('activity_logs')
            ->select(
                'activity_logs.id',
                'activity_logs.date',
                'activity_logs.user_id',
                'activity_logs.action',
                'users.client_id',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('users', 'activity_logs.user_id', '=', 'users.id')
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->where('clients.id', '=', $id)
            ->get();

        return $activitylogs;
    }

    public function store(Request $request)
    {
        $activitylog = new activity_logs();

        try {
            $activitylog->date = $request->date;
            $activitylog->user_id = $request->user_id;
            $activitylog->action = $request->action;
            $activitylog->save();

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
