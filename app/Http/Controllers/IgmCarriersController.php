<?php

namespace App\Http\Controllers;

use App\Models\igm_carriers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmCarriersController extends Controller
{
    public function index()
    {
        $igmcarriers = DB::table('igm_carriers')
            ->select(
                'igm_carriers.id',
                'igm_carriers.client_id',
                'igm_carriers.customs_office_code',
                'igm_carriers.place_of_destination_code',
                'igm_carriers.sender_id',
                'igm_carriers.pan_number',
                'igm_carriers.receiver_id',
                'igm_carriers.version_no',
                'igm_carriers.client_id_shipper',
                'clients.client_code',
                'clients.client_name',
                'shipper.client_code',
                'shipper.client_name'
            )
            ->join('clients', 'igm_carriers.client_id', '=', 'clients.id')
            ->join('clients as shipper', 'igm_carriers.client_id_shipper', '=', 'clients.id')
            ->paginate(50);

        return $igmcarriers;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igmcarriers = DB::table('igm_carriers')
            ->select(
                'igm_carriers.id',
                'igm_carriers.client_id',
                'igm_carriers.customs_office_code',
                'igm_carriers.place_of_destination_code',
                'igm_carriers.sender_id',
                'igm_carriers.pan_number',
                'igm_carriers.receiver_id',
                'igm_carriers.version_no',
                'igm_carriers.client_id_shipper',
                'clients.client_code',
                'clients.client_name',
                'shipper.client_code',
                'shipper.client_name'
            )
            ->join('clients', 'igm_carriers.client_id', '=', 'clients.id')
            ->join('clients as shipper', 'igm_carriers.client_id_shipper', '=', 'clients.id')
            ->where('igm_carriers.id', '=', $id)
            ->get();

        return $igmcarriers;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $igmcarriers = DB::table('igm_carriers')
            ->select(
                'igm_carriers.id',
                'igm_carriers.client_id',
                'igm_carriers.customs_office_code',
                'igm_carriers.place_of_destination_code',
                'igm_carriers.sender_id',
                'igm_carriers.pan_number',
                'igm_carriers.receiver_id',
                'igm_carriers.version_no',
                'igm_carriers.client_id_shipper',
                'clients.client_code',
                'clients.client_name',
                'shipper.client_code',
                'shipper.client_name'
            )
            ->join('clients', 'igm_carriers.client_id', '=', 'clients.id')
            ->join('clients as shipper', 'igm_carriers.client_id_shipper', '=', 'clients.id')
            ->where(function ($q) use ($query) {
                $q->where('igm_carriers.customs_office_code', 'like', '%' . $query . '%')
                    ->orWhere('igm_carriers.place_of_destination_code', 'like', '%' . $query . '%')
                    ->orWhere('igm_carriers.pan_number', 'like', '%' . $query . '%')
                    ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                    ->orWhere('clients.client_name', 'like', '%' . $query . '%')
                    ->orWhere('shipper.client_code', 'like', '%' . $query . '%')
                    ->orWhere('shipper.client_name', 'like', '%' . $query . '%');
            })
                ->get();
        }

        return $igmcarriers;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_carriers = new igm_carriers();
        } else { // update

            $igm_carriers = igm_carriers::find($id);
        }


        try {
            $igm_carriers->client_id = $request->client_id;
            $igm_carriers->customs_office_code = $request->customs_office_code;
            $igm_carriers->place_of_destination_code = $request->place_of_destination_code;
            $igm_carriers->sender_id = $request->sender_id;
            $igm_carriers->pan_number = $request->pan_number;
            $igm_carriers->receiver_id = $request->receiver_id;
            $igm_carriers->version_no = $request->version_no;
            $igm_carriers->client_id_shipper = $request->client_id_shipper;
            $igm_carriers->save();


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
