<?php

namespace App\Http\Controllers;

use App\Models\vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendorsController extends Controller
{
    public function index()
    {
        $vendors = DB::table('vendors')
            ->select(
                'vendors.id',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'vendors.sub_code',
                'vendors.country_id',
                'vendors.port_id',
                'vendors.email',
                'vendors.telephone_number',
                'vendors.fax',
                'vendors.mobile_number',
                'vendors.contact_name',
                'vendors.address',
                'vendors.image',
                'vendors.remarks',
                'vendors.is_active',
                'countries.country_name',
                'countries.capital_city_name',
                'ports.port_code',
                'ports.port_name',
                'ports.sub_code'
            )
            ->join('countries', 'vendors.country_id', '=', 'countries.id')
            ->join('ports', 'vendors.port_id', '=', 'ports.id')
            ->paginate(50);

        return $vendors;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $vendors = DB::table('vendors')
            ->select(
                'vendors.id',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'vendors.sub_code',
                'vendors.country_id',
                'vendors.port_id',
                'vendors.email',
                'vendors.telephone_number',
                'vendors.fax',
                'vendors.mobile_number',
                'vendors.contact_name',
                'vendors.address',
                'vendors.image',
                'vendors.remarks',
                'vendors.is_active',
                'countries.country_name',
                'countries.capital_city_name',
                'ports.port_code',
                'ports.port_name',
                'ports.sub_code'
            )
            ->join('countries', 'vendors.country_id', '=', 'countries.id')
            ->join('ports', 'vendors.port_id', '=', 'ports.id')
            ->where('vendors.id', '=', $id)
            ->get();

        return $vendors;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $vendors = DB::table('vendors')
            ->select(
                'vendors.id',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'vendors.sub_code',
                'vendors.country_id',
                'vendors.port_id',
                'vendors.email',
                'vendors.telephone_number',
                'vendors.fax',
                'vendors.mobile_number',
                'vendors.contact_name',
                'vendors.address',
                'vendors.image',
                'vendors.remarks',
                'vendors.is_active',
                'countries.country_name',
                'countries.capital_city_name',
                'ports.port_code',
                'ports.port_name',
                'ports.sub_code'
            )
            ->join('countries', 'vendors.country_id', '=', 'countries.id')
            ->join('ports', 'vendors.port_id', '=', 'ports.id')
                ->where(function ($q) use ($query) {
                    $q->where('vendors.vendor_code', 'like', '%' . $query . '%')
                        ->orWhere('vendors.vendor_name', 'like', '%' . $query . '%')
                        ->orWhere('vendors.email', 'like', '%' . $query . '%')
                        ->orWhere('vendors.mobile_number', 'like', '%' . $query . '%')
                        ->orWhere('vendors.is_active', 'like', '%' . $query . '%')
                        ->orWhere('countries.country_name', 'like', '%' . $query . '%')
                        ->orWhere('ports.port_code', 'like', '%' . $query . '%')
                        ->orWhere('ports.port_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $vendors;
    }

    public function showByFilter(Request $request)
    {
        $vendors = DB::table('vendors')
        ->select(
            'vendors.id',
            'vendors.vendor_code',
            'vendors.vendor_name',
            'vendors.sub_code',
            'vendors.country_id',
            'vendors.port_id',
            'vendors.email',
            'vendors.telephone_number',
            'vendors.fax',
            'vendors.mobile_number',
            'vendors.contact_name',
            'vendors.address',
            'vendors.image',
            'vendors.remarks',
            'vendors.is_active',
            'countries.country_name',
            'countries.capital_city_name',
            'ports.port_code',
            'ports.port_name',
            'ports.sub_code'
        )
        ->join('countries', 'vendors.country_id', '=', 'countries.id')
        ->join('ports', 'vendors.port_id', '=', 'ports.id');

        if (!empty($request->country_id) && !empty($request->port_id)) {

             $vendors = $vendors
             ->where('vendors.country_id', '=', $request->country_id)
             ->where('vendors.port_id', '=', $request->port_id);
        }
        elseif (!empty($request->country_id) && empty($request->id)) {

            $vendors = $vendors->where('vendors.country_id', '=', $request->country_id);
        }
        elseif (empty($request->country_id) && !empty($request->port_id)) {

            $vendors = $vendors
            ->where('vendors.port_id', '=', $request->port_id);
        }
        else
        {

            $vendors = $vendors;
        }

        $result = $vendors->orderBy('vendors.id')
            ->get();
        return $result;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            if ($request['email'] == null) {
                $this->validate($request, [
                    'vendor_code' => 'required|unique:vendors,vendor_code',
                    'vendor_name' => 'required|unique:vendors,vendor_name'
                ]);
            } else {
                $this->validate($request, [
                    'email' => 'unique:clients,email',
                    'vendor_code' => 'required|unique:vendors,vendor_code',
                    'vendor_name' => 'required|unique:vendors,vendor_name'
                ]);
            }

            $vendor = new vendors();
        } else { // update

            if ($request['email'] == null) {
                $this->validate($request, [
                    'vendor_code' => 'required|unique:vendors,vendor_code,' . $id,
                    'vendor_name' => 'required|unique:vendors,vendor_name,' . $id
                ]);
            } else {
                $this->validate($request, [
                    'email' => 'unique:clients,email,' . $id,
                    'vendor_code' => 'required|unique:vendors,vendor_code,' . $id,
                    'vendor_name' => 'required|unique:vendors,vendor_name,' . $id
                ]);
            }

            $vendor = vendors::find($id);
        }

        try {
            $vendor->vendor_code = $request->vendor_code;
            $vendor->vendor_name = $request->vendor_name;
            $vendor->sub_code = $request->sub_code;
            $vendor->country_id = $request->country_id;
            $vendor->port_id = $request->port_id;
            $vendor->email = $request->email;
            $vendor->telephone_number = $request->telephone_number;
            $vendor->fax = $request->fax;
            $vendor->mobile_number = $request->mobile_number;
            $vendor->contact_name = $request->contact_name;
            $vendor->address = $request->address;
            // $employee->image=$request->file('image');
            $vendor->remarks = $request->remarks;
            $vendor->is_active = $request->is_active;
            $vendor->save();

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

        $vendor = vendors::find($id);
        $vendor->is_active = $status;
        $vendor->save();

        return 'Done';
    }
}
