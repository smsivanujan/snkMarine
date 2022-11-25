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
                'equipments.equipment_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('equipments', 'swaps.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swaps.client_id_agent', '=', 'clients.id')
            ->paginate(50);

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
                'equipments.equipment_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('equipments', 'swaps.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swaps.client_id_agent', '=', 'clients.id')
            ->where('swaps.id', '=', $id)
            ->get();

        return $swaps;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $swaps = DB::table('swaps')
            ->select(
                'swaps.id',
                'swaps.date',
                'swaps.equipment_id',
                'swaps.description',
                'swaps.client_id_agent',
                'equipments.equipment_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('equipments', 'swaps.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swaps.client_id_agent', '=', 'clients.id')
                ->where(function ($q) use ($query) {
                    $q->where('swaps.date', 'like', '%' . $query . '%')
                        ->orWhere('equipments.equipment_number', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $swaps;
    }

    public function showByFilter(Request $request)
    {
        $fdate = isset($request->fdate) ? $request->fdate : date('Y-m-d');
        $tdate = isset($request->tdate) ? $request->tdate : date('Y-m-d');

        $swaps = DB::table('swaps')
            ->select(
                'swaps.id',
                'swaps.date',
                'swaps.equipment_id',
                'swaps.description',
                'swaps.client_id_agent',
                'equipments.equipment_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('equipments', 'swaps.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swaps.client_id_agent', '=', 'clients.id')
            ->where(DB::raw('DATE_FORMAT(swaps.date, "%Y-%m-%d")'), '>=', $fdate)
            ->where(DB::raw('DATE_FORMAT(swaps.date, "%Y-%m-%d")'), '<=', $tdate);

        if (!empty($request->equipment_id) && !empty($request->client_id_agent)) {

             $swaps = $swaps
             ->where('swaps.equipment_id', '=', $request->equipment_id)
            ->where('swaps.client_id_agent', '=', $request->client_id_agent);
        }
        elseif (!empty($request->equipment_id) && empty($request->client_id_agent)) {

            $swaps = $swaps->where('swaps.equipment_id', '=', $request->equipment_id);
        }
        elseif (empty($request->equipment_id) && !empty($request->client_id_agent)) {

            $swaps = $swaps
            ->where('swaps.client_id_agent', '=', $request->client_id_agent);
        }
        else
        {

            $swaps = $swaps;
        }

        $result = $swaps->orderBy('swaps.id')
            ->get();
        return $result;
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
