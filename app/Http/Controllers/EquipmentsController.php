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
                'equipments.typeofunit_id',
                'equipments.grade',
                'equipments.status',
                'equipments.vendor_id_yard',
                'equipments.client_id_agent',
                'owners.owner_code',
                'owners.owner_name',
                'typeofunits.type_of_unit',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('owners', 'equipments.owner_id', '=', 'owners.id')
            ->join('typeofunits', 'equipments.typeofunit_id', '=', 'typeofunits.id')
            ->join('vendors', 'equipments.vendor_id_yard', '=', 'vendors.id')
            ->join('clients', 'equipments.client_id_agent', '=', 'clients.id')
            ->get();

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
                'equipments.typeofunit_id',
                'equipments.grade',
                'equipments.status',
                'equipments.vendor_id_yard',
                'equipments.client_id_agent',
                'owners.owner_code',
                'owners.owner_name',
                'typeofunits.type_of_unit',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('owners', 'equipments.owner_id', '=', 'owners.id')
            ->join('typeofunits', 'equipments.typeofunit_id', '=', 'typeofunits.id')
            ->join('vendors', 'equipments.vendor_id_yard', '=', 'vendors.id')
            ->join('clients', 'equipments.client_id_agent', '=', 'clients.id')
            ->where('equipments.id', '=', $id)
            ->get();

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
            $equipment->typeofunit_id = $request->typeofunit_id;
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
