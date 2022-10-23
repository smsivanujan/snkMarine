<?php

namespace App\Http\Controllers;

use App\Models\swaps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SwapsController extends Controller
{
    public function index()
    {
        $swaps = DB::table('swaps')
            ->select(
                'swaps.id',
                'swaps.date',
                'swaps.equipment_id',
                'swaps.description',
                'swaps.client_id_agent',
                'equipments.equipment_number'
            )
            ->join('equipments', 'swaps.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swaps.client_id_agent', '=', 'clients.id')
            ->get();

        return $swaps;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $swaps = DB::table('swaps')
            ->select(
                'swaps.id',
                'swaps.date',
                'swaps.equipment_id',
                'swaps.description',
                'swaps.client_id_agent',
                'equipments.equipment_number'
            )
            ->join('equipments', 'swaps.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swaps.client_id_agent', '=', 'clients.id')
            ->where('swaps.id', '=', $id)
            ->get();

        return $swaps;
    }

    public function store(Request $request)
    {
        $id = $request->id;
        
        if ($id == 0) { // create

            $swap = new swaps();

        } else { // update

            $swap = swaps::find($id);
        }

        try {
            $swap->date = $request->date;
            $swap->equipment_id = $request->equipment_id;
            $swap->description = $request->description;
            $swap->client_id_agent = $request->client_id_agent;
            $swap->save();

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
