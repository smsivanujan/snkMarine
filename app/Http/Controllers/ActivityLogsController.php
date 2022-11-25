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

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

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
                ->where(function ($q) use ($query) {
                    $q->where('activity_logs.date', 'like', '%' . $query . '%')
                        ->orWhere('activity_logs.action', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $activitylogs;
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

        $fdate = isset($request->fdate) ? $request->fdate : date('Y-m-d');
        $tdate = isset($request->tdate) ? $request->tdate : date('Y-m-d');

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
            ->where(DB::raw('DATE_FORMAT(activity_logs.date, "%Y-%m-%d")'), '>=', $fdate)
            ->where(DB::raw('DATE_FORMAT(activity_logs.date, "%Y-%m-%d")'), '<=', $tdate);

        if (!empty($request->client_id) ) {

            $activitylogs = $activitylogs
                ->where('users.client_id', '=', $request->client_id);
        } else {

            $activitylogs = $activitylogs;
        }

        $result = $activitylogs->orderBy('activity_logs.id')
            ->get();
        return $result;
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
