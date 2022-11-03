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
        $equipments = DB::table('detention_traffies')
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
            ->get();

        return $equipments;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $equipments = DB::table('detention_traffies')
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

        return $equipments;
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
}
