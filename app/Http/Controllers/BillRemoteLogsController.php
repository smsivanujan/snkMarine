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
            ->get();

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
