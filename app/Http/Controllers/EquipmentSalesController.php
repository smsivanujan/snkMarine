<?php

namespace App\Http\Controllers;

use App\Models\equipment_sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EquipmentSalesController extends Controller
{
    public function index()
    {
        $equipmentsales = DB::table('equipment_sales')
            ->select(
                'equipment_sales.id',
                'equipment_sales.date',
                'equipment_sales.client_id',
                'equipment_sales.no_unit',
                'equipment_sales.sale_type',
                'equipment_sales.description',
                'equipment_sales.client_id_agent',
                'clients.client_code',
                'clients.client_name',
                'agent.client_code',
                'agent.client_name'
            )
            ->join('clients', 'equipment_sales.client_id', '=', 'clients.id')
            ->join('clients as agent', 'equipment_sales.client_id_agent', '=', 'agent.id')
            ->paginate(50);

        return $equipmentsales;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $equipmentsales = DB::table('equipment_sales')
            ->select(
                'equipment_sales.id',
                'equipment_sales.date',
                'equipment_sales.client_id',
                'equipment_sales.no_unit',
                'equipment_sales.sale_type',
                'equipment_sales.description',
                'equipment_sales.client_id_agent',
                'clients.client_code',
                'clients.client_name',
                'agent.client_code',
                'agent.client_name'
            )
            ->join('clients', 'equipment_sales.client_id', '=', 'clients.id')
            ->join('clients as agent', 'equipment_sales.client_id_agent', '=', 'agent.id')
            ->where('equipment_sales.id', '=', $id)
            ->get();

        return $equipmentsales;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $equipmentsales = DB::table('equipment_sales')
            ->select(
                'equipment_sales.id',
                'equipment_sales.date',
                'equipment_sales.client_id',
                'equipment_sales.no_unit',
                'equipment_sales.sale_type',
                'equipment_sales.description',
                'equipment_sales.client_id_agent',
                'clients.client_code',
                'clients.client_name',
                'agent.client_code',
                'agent.client_name'
            )
            ->join('clients', 'equipment_sales.client_id', '=', 'clients.id')
            ->join('clients as agent', 'equipment_sales.client_id_agent', '=', 'agent.id')
                ->where(function ($q) use ($query) {
                    $q->where('equipment_sales.date', 'like', '%' . $query . '%')
                    ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                    ->orWhere('clients.client_name', 'like', '%' . $query . '%')
                    ->orWhere('agent.client_code', 'like', '%' . $query . '%')
                    ->orWhere('agent.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $equipmentsales;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $equipmentsale = new equipment_sales();
        } else { // update

            $equipmentsale = equipment_sales::find($id);
        }


        try {
            $equipmentsale->date = $request->date;
            $equipmentsale->client_id = $request->client_id;
            $equipmentsale->no_unit = $request->no_unit;
            $equipmentsale->sale_type = $request->sale_type;
            $equipmentsale->description = $request->description;
            $equipmentsale->client_id_agent = $request->client_id_agent;
            $equipmentsale->save();

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
