<?php

namespace App\Http\Controllers;

use App\Models\clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = DB::table('clients')
            ->select(
                'clients.id',
                'clients.client_code',
                'clients.client_name',
                'clients.sub_code',
                'clients.country_id',
                'clients.port_id',
                'clients.email',
                'clients.telephone_number',
                'clients.fax',
                'clients.mobile_number',
                'clients.contact_name',
                'clients.address',
                'clients.image',
                'clients.currency_id',
                'clients.remarks',
                'clients.is_active',
                'countries.country_name',
                'countries.capital_city_name',
                'ports.port_code',
                'ports.port_name',
                'ports.sub_code',
                'ports.country_id',
                'currencies.currency_code',
                'currencies.currency_name'
            )
            ->join('countries', 'clients.country_id', '=', 'countries.id')
            ->join('ports', 'clients.port_id', '=', 'ports.id')
            ->join('currencies', 'clients.currency_id', '=', 'currencies.id')
            ->paginate(50);

        return $clients;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $clients = DB::table('clients')
            ->select(
                'clients.id',
                'clients.client_code',
                'clients.client_name',
                'clients.sub_code',
                'clients.country_id',
                'clients.port_id',
                'clients.email',
                'clients.telephone_number',
                'clients.fax',
                'clients.mobile_number',
                'clients.contact_name',
                'clients.address',
                'clients.image',
                'clients.currency_id',
                'clients.remarks',
                'clients.is_active',
                'countries.country_name',
                'countries.capital_city_name',
                'ports.port_code',
                'ports.port_name',
                'ports.sub_code',
                'ports.country_id',
                'currencies.currency_code',
                'currencies.currency_name'
            )
            ->join('countries', 'clients.country_id', '=', 'countries.id')
            ->join('ports', 'clients.port_id', '=', 'ports.id')
            ->join('currencies', 'clients.currency_id', '=', 'currencies.id')
            ->where('clients.id', '=', $id)
            ->get();

        return $clients;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            if ($request['email'] == null) {
                $this->validate($request, [
                    'client_code' => 'required|unique:clients,client_code',
                    'client_name' => 'required|unique:clients,client_name'
                ]);
            } else {
                $this->validate($request, [
                    'email' => 'unique:clients,email',
                    'client_code' => 'required|unique:clients,client_code',
                    'client_name' => 'required|unique:clients,client_name'
                ]);
            }

            $client = new clients();
        } else { // update

            if ($request['email'] == null) {
                $this->validate($request, [
                    'client_code' => 'required|unique:clients,client_code,' . $id,
                    'client_name' => 'required|unique:clients,client_name,' . $id
                ]);
            } else {
                $this->validate($request, [
                    'email' => 'unique:clients,email,' . $id,
                    'client_code' => 'required|unique:clients,client_code,' . $id,
                    'client_name' => 'required|unique:clients,client_name,' . $id
                ]);
            }

            $client = clients::find($id);
        }

        try {
            $client->client_code = $request->client_code;
            $client->client_name = $request->client_name;
            $client->sub_code = $request->sub_code;
            $client->country_id = $request->country_id;
            $client->port_id = $request->port_id;
            $client->email = $request->email;
            $client->telephone_number = $request->telephone_number;
            $client->fax = $request->fax;
            $client->mobile_number = $request->mobile_number;
            $client->contact_name = $request->contact_name;
            $client->address = $request->address;
            // $employee->image=$request->file('image');
            $client->currency_id = $request->currency_id;
            $client->remarks = $request->remarks;
            $client->is_active = $request->is_active;
            $client->save();

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

        $client = clients::find($id);
        $client->is_active = $status;
        $client->save();

        return 'Done';
    }
}
