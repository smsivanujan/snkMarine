<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingsController extends Controller
{
    public function index()
    {
        $billoflanding = DB::table('bill_of_landings')
            ->select(
                'bill_of_landings.id',
                'bill_of_landings.date',
                'bill_of_landings.bill_of_landing_number',
                'bill_of_landings.booking_confirmation_id',
                'bill_of_landings.client_id_shipper',
                'bill_of_landings.export_references',
                'bill_of_landings.client_id_consignee',
                'bill_of_landings.client_id_fw_agent',
                'bill_of_landings.client_id_notify',
                'bill_of_landings.port_id_loading',
                'bill_of_landings.port_id_discharge',
                'bill_of_landings.port_id_final_dest',
                'bill_of_landings.port_id_loading_bl',
                'bill_of_landings.port_id_discharge_bl',
                'bill_of_landings.port_id_final_dest_bl',
                'bill_of_landings.detention_free_days',
                'bill_of_landings.detention_description',
                'bill_of_landings.pre_carriage_by',
                'bill_of_landings.place_of_receipt',
                'bill_of_landings.ship_on_board_date',
                'bill_of_landings.country_id_origin',
                'bill_of_landings.country_id_bltb_released',
                'bill_of_landings.igm_india_voyage_id',
                'bill_of_landings.voyage_number',
                'bill_of_landings.ocean_freight',
                'bill_of_landings.country_id_ocefrepayable',
                'bill_of_landings.traffic_mode_id',
                'bill_of_landings.no_of_bls',
                'bill_of_landings.bl_type',
                'bill_of_landings.special_instructions',
                'bill_of_landings.shipper_loaded',
                'bill_of_landings.hide_shipped_date',
                'bill_of_landings.status_1',
                'bill_of_landings.status_2',
                'booking_confirmations.booking_confirmation_number',
                'shipper.client_code',
                'shipper.client_name',
                'consignee.client_code',
                'consignee.client_name',
                'fw_agent.client_code',
                'fw_agent.client_name',
                'notify.client_code',
                'notify.client_name',
                'portloading.port_code',
                'portloading.port_name',
                'discharge.port_code',
                'discharge.port_name',
                'final_dest.port_code',
                'final_dest.port_name',
                'discharge_bl.port_code',
                'discharge_bl.port_name',
                'final_dest_bl.port_code',
                'final_dest_bl.port_name',
                'origin.country_name',
                'bltb_released.country_name',
                'ocefrepayable.country_name',
                'traffic_modes.trafficmode_type'
            )
            ->join('booking_confirmations', 'bill_of_landings.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('clients as shipper', 'bill_of_landings.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'bill_of_landings.client_id_consignee', '=', 'consignee.id')
            ->join('clients as fw_agent', 'bill_of_landings.client_id_fw_agent', '=', 'fw_agent.id')
            ->join('clients as notify', 'bill_of_landings.client_id_notify', '=', 'notify.id')
            ->join('ports as portloading', 'bill_of_landings.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'bill_of_landings.port_id_discharge', '=', 'discharge.id')
            ->join('ports as final_dest', 'bill_of_landings.port_id_final_dest', '=', 'final_dest.id')
            ->join('ports as loading_bl', 'bill_of_landings.port_id_loading_bl', '=', 'loading_bl.id')
            ->join('ports as discharge_bl', 'bill_of_landings.port_id_discharge_bl', '=', 'discharge_bl.id')
            ->join('ports as final_dest_bl', 'bill_of_landings.port_id_final_dest_bl', '=', 'final_dest_bl.id')
            ->join('countries as origin', 'bill_of_landings.country_id_origin', '=', 'origin.id')
            ->join('countries as bltb_released', 'bill_of_landings.country_id_bltb_released', '=', 'bltb_released.id')
            ->join('countries as ocefrepayable', 'bill_of_landings.country_id_ocefrepayable', '=', 'ocefrepayable.id')
            ->join('traffic_modes', 'bill_of_landings.traffic_mode_id', '=', 'traffic_nodes.id')
            ->get();

        return $billoflanding;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflanding = DB::table('bill_of_landings')
            ->select(
                'bill_of_landings.id',
                'bill_of_landings.date',
                'bill_of_landings.bill_of_landing_number',
                'bill_of_landings.booking_confirmation_id',
                'bill_of_landings.client_id_shipper',
                'bill_of_landings.export_references',
                'bill_of_landings.client_id_consignee',
                'bill_of_landings.client_id_fw_agent',
                'bill_of_landings.client_id_notify',
                'bill_of_landings.port_id_loading',
                'bill_of_landings.port_id_discharge',
                'bill_of_landings.port_id_final_dest',
                'bill_of_landings.port_id_loading_bl',
                'bill_of_landings.port_id_discharge_bl',
                'bill_of_landings.port_id_final_dest_bl',
                'bill_of_landings.detention_free_days',
                'bill_of_landings.detention_description',
                'bill_of_landings.pre_carriage_by',
                'bill_of_landings.place_of_receipt',
                'bill_of_landings.ship_on_board_date',
                'bill_of_landings.country_id_origin',
                'bill_of_landings.country_id_bltb_released',
                'bill_of_landings.igm_india_voyage_id',
                'bill_of_landings.voyage_number',
                'bill_of_landings.ocean_freight',
                'bill_of_landings.country_id_ocefrepayable',
                'bill_of_landings.traffic_mode_id',
                'bill_of_landings.no_of_bls',
                'bill_of_landings.bl_type',
                'bill_of_landings.special_instructions',
                'bill_of_landings.shipper_loaded',
                'bill_of_landings.hide_shipped_date',
                'bill_of_landings.status_1',
                'bill_of_landings.status_2',
                'booking_confirmations.booking_confirmation_number',
                'shipper.client_code',
                'shipper.client_name',
                'consignee.client_code',
                'consignee.client_name',
                'fw_agent.client_code',
                'fw_agent.client_name',
                'notify.client_code',
                'notify.client_name',
                'portloading.port_code',
                'portloading.port_name',
                'discharge.port_code',
                'discharge.port_name',
                'final_dest.port_code',
                'final_dest.port_name',
                'discharge_bl.port_code',
                'discharge_bl.port_name',
                'final_dest_bl.port_code',
                'final_dest_bl.port_name',
                'origin.country_name',
                'bltb_released.country_name',
                'ocefrepayable.country_name',
                'traffic_modes.trafficmode_type'
            )
            ->join('booking_confirmations', 'bill_of_landings.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('clients as shipper', 'bill_of_landings.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'bill_of_landings.client_id_consignee', '=', 'consignee.id')
            ->join('clients as fw_agent', 'bill_of_landings.client_id_fw_agent', '=', 'fw_agent.id')
            ->join('clients as notify', 'bill_of_landings.client_id_notify', '=', 'notify.id')
            ->join('ports as portloading', 'bill_of_landings.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'bill_of_landings.port_id_discharge', '=', 'discharge.id')
            ->join('ports as final_dest', 'bill_of_landings.port_id_final_dest', '=', 'final_dest.id')
            ->join('ports as loading_bl', 'bill_of_landings.port_id_loading_bl', '=', 'loading_bl.id')
            ->join('ports as discharge_bl', 'bill_of_landings.port_id_discharge_bl', '=', 'discharge_bl.id')
            ->join('ports as final_dest_bl', 'bill_of_landings.port_id_final_dest_bl', '=', 'final_dest_bl.id')
            ->join('countries as origin', 'bill_of_landings.country_id_origin', '=', 'origin.id')
            ->join('countries as bltb_released', 'bill_of_landings.country_id_bltb_released', '=', 'bltb_released.id')
            ->join('countries as ocefrepayable', 'bill_of_landings.country_id_ocefrepayable', '=', 'ocefrepayable.id')
            ->join('traffic_modes', 'bill_of_landings.traffic_mode_id', '=', 'traffic_nodes.id')
            ->where('bill_of_landings.id', '=', $id)
            ->get();

        return $billoflanding;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
                $this->validate($request, [
                    'bill_of_landing_number' => 'unique:bill_of_landings,bill_of_landing_number'
                ]);

            $billoflanding = new bill_of_landings();
        } else { // update
                $this->validate($request, [
                    'bill_of_landing_number' => 'unique:bill_of_landings,bill_of_landing_number,' . $id,
                ]);
           
            $billoflanding = bill_of_landings::find($id);
        }

        try {
            $billoflanding->bill_of_landing_number = $request->bill_of_landing_number;
            $billoflanding->booking_confirmation_id = $request->booking_confirmation_id;
            $billoflanding->client_id_shipper = $request->client_id_shipper;
            $billoflanding->export_references = $request->export_references;
            $billoflanding->client_id_consignee = $request->client_id_consignee;
            $billoflanding->client_id_fw_agent = $request->client_id_fw_agent;
            $billoflanding->client_id_notify = $request->client_id_notify;
            $billoflanding->port_id_loading = $request->port_id_loading;
            $billoflanding->port_id_discharge = $request->port_id_discharge;
            $billoflanding->port_id_final_dest = $request->port_id_final_dest;
            $billoflanding->port_id_loading_bl = $request->port_id_loading_bl;
            $billoflanding->port_id_discharge_bl=$request->port_id_discharge_bl;
            $billoflanding->port_id_final_dest_bl = $request->port_id_final_dest_bl;
            $billoflanding->detention_free_days = $request->detention_free_days;
            $billoflanding->detention_description = $request->detention_description;
            $billoflanding->pre_carriage_by = $request->pre_carriage_by;
            $billoflanding->place_of_receipt = $request->place_of_receipt;
            $billoflanding->ship_on_board_date = $request->ship_on_board_date;
            $billoflanding->export_references = $request->export_references;
            $billoflanding->country_id_origin = $request->country_id_origin;
            $billoflanding->country_id_bltb_released = $request->country_id_bltb_released;
            $billoflanding->igm_india_voyage_id = $request->igm_india_voyage_id;
            $billoflanding->voyage_number = $request->voyage_number;
            $billoflanding->ocean_freight = $request->ocean_freight;
            $billoflanding->country_id_ocefrepayable = $request->country_id_ocefrepayable;
            $billoflanding->traffic_mode_id = $request->traffic_mode_id;
            $billoflanding->no_of_bls=$request->no_of_bls;
            $billoflanding->bl_type = $request->bl_type;
            $billoflanding->special_instructions = $request->special_instructions;
            $billoflanding->shipper_loaded = $request->shipper_loaded;
            $billoflanding->hide_shipped_date = $request->hide_shipped_date;
            $billoflanding->status_1 = $request->status_1;
            $billoflanding->status_2 = $request->status_2;
            $billoflanding->save();

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
