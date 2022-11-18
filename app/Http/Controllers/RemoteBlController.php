<?php

namespace App\Http\Controllers;

use App\Models\remote_bl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RemoteBlController extends Controller
{
    public function index()
    {
        $remotebls = DB::table('remote_bls')
            ->select(
                'remote_bls.id',
                'remote_bls.bill_of_landing_id',
                'remote_bls.bl_string',
                'remote_bls.client_id_agent',
                'bill_of_landings.bill_of_landing_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('bill_of_landings', 'remote_bls.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients', 'remote_bls.client_id_agent', '=', 'clients.id')
            ->paginate(50);

        return $remotebls;
    }

    // public function showById(Request $request)
    // {
    //     $id = $request->id;
    //     $equipments = DB::table('equipments')
    //         ->select(
    //             'equipments.id',
    //             'equipments.equipment_number',
    //             'equipments.owner_id',
    //             'equipments.type_of_unit_id',
    //             'equipments.grade',
    //             'equipments.status',
    //             'equipments.vendor_id_yard',
    //             'equipments.client_id_agent',
    //             'owners.owner_code',
    //             'owners.owner_name',
    //             'type_of_units.type_of_unit',
    //             'vendors.vendor_code',
    //             'vendors.vendor_name',
    //             'clients.client_code',
    //             'clients.client_name'
    //         )
    //         ->join('owners', 'equipments.owner_id', '=', 'owners.id')
    //         ->join('type_of_units', 'equipments.type_of_unit_id', '=', 'type_of_units.id')
    //         ->join('vendors', 'equipments.vendor_id_yard', '=', 'vendors.id')
    //         ->join('clients', 'equipments.client_id_agent', '=', 'clients.id')
    //         ->where('equipments.id', '=', $id)
    //         ->get();

    //     return $equipments;
    // }

    public function store(Request $request)
    {
        $id = $request->id;


        $remote_bl = new remote_bl();


        try {
            $remote_bl->bill_of_landing_id = $request->bill_of_landing_id;
            $remote_bl->bl_string = $request->bl_string;
            $remote_bl->client_id_agent = $request->client_id_agent;
            $remote_bl->save();

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
