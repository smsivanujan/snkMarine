<?php

namespace App\Http\Controllers;

use App\Models\igms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmsController extends Controller
{
    public function index()
    {
        $igms = DB::table('igms')
            ->select(
                'igms.id',
                'igms.bill_of_landing_id',
                'igms.customs_office_code',
                'igms.igm_india_voyage_id',
                'igms.date_of_departure',
                'igms.date_of_arrival',
                'igms.time_of_arrival',
                'igms.total_number_of_bols',
                'igms.total_number_of_packages',
                'igms.total_number_of_containers',
                'igms.total_gross_mass',
                'igms.consolidated_cargo',
                'igms.place_of_loading_code',
                'igms.place_of_unloading_code',
                'igms.exporter_name',
                'igms.exporter_address',
                'igms.number_of_packages',
                'igms.package_type_code',
                'igms.gross_mass',
                'igms.shipping_marks',
                'igms.volume_in_cubic_meters',
                'igms.num_of_ctn_for_this_bol',
                'igms.mode_of_transport_code',
                'igms.identity_of_transporter',
                'igms.nationality_of_transporter_code',
                'igms.slpa_ref_number',
                'igms.bol_reference',
                'igms.line_number',
                'igms.bol_nature',
                'igms.bol_type_code',
                'igms.place_of_departure_code',
                'igms.place_of_destination_code',
                'igms.unique_carrier_reference',
                'igms.client_id_carrier',
                'igms.client_id_notify',
                'igms.client_id_cosignee',
                'igms.freight_value',
                'igms.freight_currency',
                'igms.goods_description',
                'igms.deleted',
                'bill_of_landings.bill_of_landing_number',
                'igm_india_voyages.voyage',
                'carrier.client_code',
                'carrier.client_name',
                'notify.client_code',
                'notify.client_name',  
                'cosignee.client_code',
                'cosignee.client_name'
            )
            ->join('bill_of_landings', 'igms.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('igm_india_voyages', 'igms.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('clients as carrier', 'igms.client_id_carrier', '=', 'carrier.id')
            ->join('clients as notify', 'igms.client_id_notify', '=', 'notify.id')
            ->join('clients as cosignee', 'igms.client_id_cosignee', '=', 'cosignee.id')
            ->get();

        return $igms;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igms = DB::table('igms')
            ->select(
                'igms.id',
                'igms.bill_of_landing_id',
                'igms.customs_office_code',
                'igms.igm_india_voyage_id',
                'igms.date_of_departure',
                'igms.date_of_arrival',
                'igms.time_of_arrival',
                'igms.total_number_of_bols',
                'igms.total_number_of_packages',
                'igms.total_number_of_containers',
                'igms.total_gross_mass',
                'igms.consolidated_cargo',
                'igms.place_of_loading_code',
                'igms.place_of_unloading_code',
                'igms.exporter_name',
                'igms.exporter_address',
                'igms.number_of_packages',
                'igms.package_type_code',
                'igms.gross_mass',
                'igms.shipping_marks',
                'igms.volume_in_cubic_meters',
                'igms.num_of_ctn_for_this_bol',
                'igms.mode_of_transport_code',
                'igms.identity_of_transporter',
                'igms.nationality_of_transporter_code',
                'igms.slpa_ref_number',
                'igms.bol_reference',
                'igms.line_number',
                'igms.bol_nature',
                'igms.bol_type_code',
                'igms.place_of_departure_code',
                'igms.place_of_destination_code',
                'igms.unique_carrier_reference',
                'igms.client_id_carrier',
                'igms.client_id_notify',
                'igms.client_id_cosignee',
                'igms.freight_value',
                'igms.freight_currency',
                'igms.goods_description',
                'igms.deleted',
                'bill_of_landings.bill_of_landing_number',
                'igm_india_voyages.voyage',
                'carrier.client_code',
                'carrier.client_name',
                'notify.client_code',
                'notify.client_name',  
                'cosignee.client_code',
                'cosignee.client_name'
            )
            ->join('bill_of_landings', 'igms.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('igm_india_voyages', 'igms.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('clients as carrier', 'igms.client_id_carrier', '=', 'carrier.id')
            ->join('clients as notify', 'igms.client_id_notify', '=', 'notify.id')
            ->join('clients as cosignee', 'igms.client_id_cosignee', '=', 'cosignee.id')
            ->where('igms.id', '=', $id)
            ->get();

        return $igms;
    }

    public function store(Request $request)
    {
        $id = $request->id;


        if ($id == 0) { // create

            $igms = new igms();
        } else { // update

            $igms = igms::find($id);
        }


        try {
            $igms->bill_of_landing_id = $request->bill_of_landing_id;
            $igms->customs_office_code = $request->customs_office_code;
            $igms->igm_india_voyage_id = $request->igm_india_voyage_id;
            $igms->date_of_departure = $request->date_of_departure;
            $igms->date_of_arrival = $request->date_of_arrival;
            $igms->time_of_arrival = $request->time_of_arrival;
            $igms->total_number_of_bols = $request->total_number_of_bols;
            $igms->total_number_of_packages = $request->total_number_of_packages;
            $igms->total_number_of_containers = $request->total_number_of_containers;
            $igms->total_gross_mass = $request->total_gross_mass;
            $igms->consolidated_cargo = $request->consolidated_cargo;
            $igms->place_of_loading_code = $request->place_of_loading_code;
            $igms->place_of_unloading_code = $request->place_of_unloading_code;
            $igms->exporter_name = $request->exporter_name;
            $igms->exporter_address = $request->exporter_address;
            $igms->number_of_packages = $request->number_of_packages;
            $igms->package_type_code = $request->package_type_code;
            $igms->gross_mass = $request->gross_mass;
            $igms->shipping_marks = $request->shipping_marks;
            $igms->volume_in_cubic_meters = $request->volume_in_cubic_meters;
            $igms->num_of_ctn_for_this_bol = $request->num_of_ctn_for_this_bol;
            $igms->mode_of_transport_code = $request->mode_of_transport_code;
            $igms->identity_of_transporter = $request->identity_of_transporter;
            $igms->nationality_of_transporter_code = $request->nationality_of_transporter_code;
            $igms->slpa_ref_number = $request->slpa_ref_number;
            $igms->bol_reference = $request->bol_reference;
            $igms->line_number = $request->line_number;
            $igms->bol_nature = $request->bol_nature;
            $igms->bol_type_code = $request->bol_type_code;
            $igms->place_of_departure_code = $request->place_of_departure_code;
            $igms->place_of_destination_code = $request->place_of_destination_code;
            $igms->unique_carrier_reference = $request->unique_carrier_reference;
            $igms->client_id_carrier = $request->client_id_carrier;
            $igms->client_id_notify = $request->client_id_notify;
            $igms->client_id_cosignee = $request->client_id_cosignee;
            $igms->freight_value = $request->freight_value;
            $igms->freight_currency = $request->freight_currency;
            $igms->goods_description = $request->goods_description;
            $igms->deleted = $request->deleted;
            $igms->save();


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
