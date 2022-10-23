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


            $detentiontraffies = new detention_traffies();


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
