<?php

namespace App\Http\Controllers;

use App\Models\bill_remote_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillRemoteLogsController extends Controller
{
    public function index()
    {
        $bill_remote_logs = DB::table('bill_remote_logs')
            ->select(
                'bill_remote_logs.id',
                'bill_remote_logs.bill_of_landing_id',
                'bill_remote_logs.client_id',
                'bill_remote_logs.printed_date',
                'bill_of_landings.bill_of_landing_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('bill_of_landings', 'bill_remote_logs.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients', 'bill_remote_logs.client_id', '=', 'clients.id')
            ->paginate(50);

        return $bill_remote_logs;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $bill_remote_logs = DB::table('bill_remote_logs')
            ->select(
                'bill_remote_logs.id',
                'bill_remote_logs.bill_of_landing_id',
                'bill_remote_logs.client_id',
                'bill_remote_logs.printed_date',
                'bill_of_landings.bill_of_landing_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('bill_of_landings', 'bill_remote_logs.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients', 'bill_remote_logs.client_id', '=', 'clients.id')
            ->where('bill_of_landings.id', '=', $id)
            ->get();

        return $bill_remote_logs;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $bill_remote_logs = DB::table('bill_remote_logs')
            ->select(
                'bill_remote_logs.id',
                'bill_remote_logs.bill_of_landing_id',
                'bill_remote_logs.client_id',
                'bill_remote_logs.printed_date',
                'bill_of_landings.bill_of_landing_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('bill_of_landings', 'bill_remote_logs.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients', 'bill_remote_logs.client_id', '=', 'clients.id')
                ->where(function ($q) use ($query) {
                    $q->where('bill_of_landings.bill_of_landing_number', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $bill_remote_logs;
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

        $bill_remote_logs = DB::table('bill_remote_logs')
            ->select(
                'bill_remote_logs.id',
                'bill_remote_logs.bill_of_landing_id',
                'bill_remote_logs.client_id',
                'bill_remote_logs.printed_date',
                'bill_of_landings.bill_of_landing_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('bill_of_landings', 'bill_remote_logs.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients', 'bill_remote_logs.client_id', '=', 'clients.id');

        if (!empty($request->bill_of_landing_id) && !empty($request->client_id)) {

             $bill_remote_logs = $bill_remote_logs
             ->where('bill_remote_logs.bill_of_landing_id', '=', $request->bill_of_landing_id)
             ->where('bill_remote_logs.client_id', '=', $request->client_id);
        }
        elseif (!empty($request->bill_of_landing_id) && empty($request->client_id)) {

            $accesspoints = $bill_remote_logs
            ->where('bill_remote_logs.bill_of_landing_id', '=', $request->bill_of_landing_id);
        }
        elseif (empty($request->bill_of_landing_id) && !empty($request->client_id)) {

            $bill_remote_logs = $bill_remote_logs
            ->where('bill_remote_logs.client_id', '=', $request->client_id);
        }
        else
        {

            $bill_remote_logs = $bill_remote_logs;
        }

        $result = $bill_remote_logs->orderBy('bill_remote_logs.id')
            ->get();
        return $result;
    }

    public function store(Request $request)
    {
        $billremotelogs = new bill_remote_logs();

        try {
            $billremotelogs->bill_of_landing_id = $request->bill_of_landing_id;
            $billremotelogs->client_id = $request->client_id;
            $billremotelogs->printed_date = $request->printed_date;
            $billremotelogs->save();

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
