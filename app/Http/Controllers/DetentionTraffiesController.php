<?php

namespace App\Http\Controllers;

use App\Models\detention_traffies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DetentionTraffiesController extends Controller
{
    public function index()
    {
        $detentiontraffies = DB::table('detention_traffies')
            ->select(
                'detention_traffies.id',
                'detention_traffies.client_id_agent',
                'detention_traffies.currency_id',
                'detention_traffies.free_days',
                'detention_traffies.comm',
                'detention_traffies.deleted',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'detention_traffies.client_id_agent', '=', 'clients.id')
            ->paginate(50);

        return $detentiontraffies;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $detentiontraffies = DB::table('detention_traffies')
            ->select(
                'detention_traffies.id',
                'detention_traffies.client_id_agent',
                'detention_traffies.currency_id',
                'detention_traffies.free_days',
                'detention_traffies.comm',
                'detention_traffies.deleted',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'detention_traffies.client_id_agent', '=', 'clients.id')
            ->where('detention_traffies.id', '=', $id)
            ->get();

        return $detentiontraffies;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $detentiontraffies = DB::table('detention_traffies')
            ->select(
                'detention_traffies.id',
                'detention_traffies.client_id_agent',
                'detention_traffies.currency_id',
                'detention_traffies.free_days',
                'detention_traffies.comm',
                'detention_traffies.deleted',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'detention_traffies.client_id_agent', '=', 'clients.id')
                ->where(function ($q) use ($query) {
                    $q->where('clients.client_code', 'like', '%' . $query . '%')
                    ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $detentiontraffies;
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

        $detentiontraffies = DB::table('detention_traffies')
            ->select(
                'detention_traffies.id',
                'detention_traffies.client_id_agent',
                'detention_traffies.currency_id',
                'detention_traffies.free_days',
                'detention_traffies.comm',
                'detention_traffies.deleted',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'detention_traffies.client_id_agent', '=', 'clients.id');

        if (!empty($request->client_id_agent)) {

             $detentiontraffies = $detentiontraffies
             ->where('detention_traffies.client_id_agent', '=', $request->client_id_agent);
        }
        else
        {

            $detentiontraffies = $detentiontraffies;
        }

        $result = $detentiontraffies->orderBy('detention_traffies.id')
            ->get();
        return $result;
    }
    
    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $detentiontraffies = new detention_traffies();
        } else { // update

            $detentiontraffies = detention_traffies::find($id);
        }


        try {
            $detentiontraffies->client_id_agent = $request->client_id_agent;
            $detentiontraffies->currency_id = $request->currency_id;
            $detentiontraffies->free_days = $request->free_days;
            $detentiontraffies->comm = $request->comm;
            $detentiontraffies->deleted = $request->deleted;
            $detentiontraffies->save();

            $data = [
                'is_create' => true,
                'error' => []
            ];

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }

    // status change
    public function statusChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $status = 0;//inactive
        } else {
            $status = 1;//active
        }

        $detentiontraffies = detention_traffies::find($id);
        $detentiontraffies->deleted = $status;
        $detentiontraffies->save();

        return 'Done';
    }
}
