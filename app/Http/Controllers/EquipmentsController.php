<?php

namespace App\Http\Controllers;

use App\Models\equipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EquipmentsController extends Controller
{
    public function index()
    {
        $equipments = DB::table('equipments')
            ->select(
                'equipments.id',
                'equipments.equipment_number',
                'equipments.owner_id',
                'equipments.type_of_unit_id',
                'equipments.grade',
                'equipments.status',
                'equipments.vendor_id_yard',
                'equipments.client_id_agent',
                'owners.owner_code',
                'owners.owner_name',
                'type_of_units.type_of_unit',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('owners', 'equipments.owner_id', '=', 'owners.id')
            ->join('type_of_units', 'equipments.type_of_unit_id', '=', 'type_of_units.id')
            ->join('vendors', 'equipments.vendor_id_yard', '=', 'vendors.id')
            ->join('clients', 'equipments.client_id_agent', '=', 'clients.id')
            ->paginate(50);

        return $equipments;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $equipments = DB::table('equipments')
            ->select(
                'equipments.id',
                'equipments.equipment_number',
                'equipments.owner_id',
                'equipments.type_of_unit_id',
                'equipments.grade',
                'equipments.status',
                'equipments.vendor_id_yard',
                'equipments.client_id_agent',
                'owners.owner_code',
                'owners.owner_name',
                'type_of_units.type_of_unit',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('owners', 'equipments.owner_id', '=', 'owners.id')
            ->join('type_of_units', 'equipments.type_of_unit_id', '=', 'type_of_units.id')
            ->join('vendors', 'equipments.vendor_id_yard', '=', 'vendors.id')
            ->join('clients', 'equipments.client_id_agent', '=', 'clients.id')
            ->where('equipments.id', '=', $id)
            ->get();

        return $equipments;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $equipments = DB::table('equipments')
            ->select(
                'equipments.id',
                'equipments.equipment_number',
                'equipments.owner_id',
                'equipments.type_of_unit_id',
                'equipments.grade',
                'equipments.status',
                'equipments.vendor_id_yard',
                'equipments.client_id_agent',
                'owners.owner_code',
                'owners.owner_name',
                'type_of_units.type_of_unit',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('owners', 'equipments.owner_id', '=', 'owners.id')
            ->join('type_of_units', 'equipments.type_of_unit_id', '=', 'type_of_units.id')
            ->join('vendors', 'equipments.vendor_id_yard', '=', 'vendors.id')
            ->join('clients', 'equipments.client_id_agent', '=', 'clients.id')
                ->where(function ($q) use ($query) {
                    $q->where('equipments.equipment_number', 'like', '%' . $query . '%')
                    ->orWhere('equipments.grade', 'like', '%' . $query . '%')
                    ->orWhere('equipments.status', 'like', '%' . $query . '%')
                    ->orWhere('owners.owner_code', 'like', '%' . $query . '%')
                    ->orWhere('owners.owner_name', 'like', '%' . $query . '%')
                    ->orWhere('type_of_units.type_of_unit', 'like', '%' . $query . '%')
                    ->orWhere('vendors.vendor_code', 'like', '%' . $query . '%')
                    ->orWhere('vendors.vendor_name', 'like', '%' . $query . '%')
                    ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                    ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $equipments;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'equipment_number' => 'required|unique:equipments,equipment_number',
            ]);


            $equipment = new equipments();
        } else { // update

            $this->validate($request, [
                'equipment_number' => 'required|unique:equipments,equipment_number,' . $id
            ]);

            $equipment = equipments::find($id);
        }

        try {
            $equipment->equipment_number = $request->equipment_number;
            $equipment->owner_id = $request->owner_id;
            $equipment->type_of_unit_id = $request->type_of_unit_id;
            $equipment->grade = $request->grade;
            $equipment->status = $request->status;
            $equipment->vendor_id_yard = $request->vendor_id_yard;
            $equipment->client_id_agent = $request->client_id_agent;
            $equipment->save();

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
