<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_non_inventories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingNonInventoriesController extends Controller
{
    public function index()
    {
        $bl_non_inventories = DB::table('bill_of_landing_non_inventories')
            ->select(
                'bill_of_landing_non_inventories.id',
                'bill_of_landing_non_inventories.date',
                'bill_of_landing_non_inventories.bill_of_landing_number',
                'bill_of_landing_non_inventories.booking_confirmation_id',
                'bill_of_landing_non_inventories.client_id_shipper',
                'bill_of_landing_non_inventories.export_references',
                'bill_of_landing_non_inventories.client_id_consignee',
                'bill_of_landing_non_inventories.client_id_fw_agent',
                'bill_of_landing_non_inventories.client_id_notify',
                'bill_of_landing_non_inventories.port_id_loading',
                'bill_of_landing_non_inventories.port_id_discharge',
                'bill_of_landing_non_inventories.port_id_final_dest',
                'bill_of_landing_non_inventories.port_id_loading_bl',
                'bill_of_landing_non_inventories.port_id_discharge_bl',
                'bill_of_landing_non_inventories.port_id_final_dest_bl',
                'bill_of_landing_non_inventories.detention_free_days',
                'bill_of_landing_non_inventories.detention_description',
                'bill_of_landing_non_inventories.pre_carriage_by',
                'bill_of_landing_non_inventories.place_of_receipt',
                'bill_of_landing_non_inventories.ship_on_board_date',
                'bill_of_landing_non_inventories.country_id_origin',
                'bill_of_landing_non_inventories.country_id_bltb_released',
                'bill_of_landing_non_inventories.igm_india_voyage_id',
                'bill_of_landing_non_inventories.voyage_number',
                'bill_of_landing_non_inventories.ocean_freight',
                'bill_of_landing_non_inventories.country_id_ocefrepayable',
                'bill_of_landing_non_inventories.traffic_mode_id',
                'bill_of_landing_non_inventories.no_of_bls',
                'bill_of_landing_non_inventories.bl_type',
                'bill_of_landing_non_inventories.special_instructions',
                'bill_of_landing_non_inventories.shipper_loaded',
                'bill_of_landing_non_inventories.status_1',
                'bill_of_landing_non_inventories.status_2',
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
            ->join('booking_confirmations', 'bill_of_landing_non_inventories.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('clients as shipper', 'bill_of_landing_non_inventories.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'bill_of_landing_non_inventories.client_id_consignee', '=', 'consignee.id')
            ->join('clients as fw_agent', 'bill_of_landing_non_inventories.client_id_fw_agent', '=', 'fw_agent.id')
            ->join('clients as notify', 'bill_of_landing_non_inventories.client_id_notify', '=', 'notify.id')
            ->join('ports as portloading', 'bill_of_landing_non_inventories.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'bill_of_landing_non_inventories.port_id_discharge', '=', 'discharge.id')
            ->join('ports as final_dest', 'bill_of_landing_non_inventories.port_id_final_dest', '=', 'final_dest.id')
            ->join('ports as loading_bl', 'bill_of_landing_non_inventories.port_id_loading_bl', '=', 'loading_bl.id')
            ->join('ports as discharge_bl', 'bill_of_landing_non_inventories.port_id_discharge_bl', '=', 'discharge_bl.id')
            ->join('ports as final_dest_bl', 'bill_of_landing_non_inventories.port_id_final_dest_bl', '=', 'final_dest_bl.id')
            ->join('countries as origin', 'bill_of_landing_non_inventories.country_id_origin', '=', 'origin.id')
            ->join('countries as bltb_released', 'bill_of_landing_non_inventories.country_id_bltb_released', '=', 'bltb_released.id')
            ->join('countries as ocefrepayable', 'bill_of_landing_non_inventories.country_id_ocefrepayable', '=', 'ocefrepayable.id')
            ->join('traffic_modes', 'bill_of_landing_non_inventories.traffic_mode_id', '=', 'traffic_modes.id')
            ->get();

        return $bl_non_inventories;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $bl_non_inventories = DB::table('bill_of_landing_non_inventories')
            ->select(
                'bill_of_landing_non_inventories.id',
                'bill_of_landing_non_inventories.date',
                'bill_of_landing_non_inventories.bill_of_landing_number',
                'bill_of_landing_non_inventories.booking_confirmation_id',
                'bill_of_landing_non_inventories.client_id_shipper',
                'bill_of_landing_non_inventories.export_references',
                'bill_of_landing_non_inventories.client_id_consignee',
                'bill_of_landing_non_inventories.client_id_fw_agent',
                'bill_of_landing_non_inventories.client_id_notify',
                'bill_of_landing_non_inventories.port_id_loading',
                'bill_of_landing_non_inventories.port_id_discharge',
                'bill_of_landing_non_inventories.port_id_final_dest',
                'bill_of_landing_non_inventories.port_id_loading_bl',
                'bill_of_landing_non_inventories.port_id_discharge_bl',
                'bill_of_landing_non_inventories.port_id_final_dest_bl',
                'bill_of_landing_non_inventories.detention_free_days',
                'bill_of_landing_non_inventories.detention_description',
                'bill_of_landing_non_inventories.pre_carriage_by',
                'bill_of_landing_non_inventories.place_of_receipt',
                'bill_of_landing_non_inventories.ship_on_board_date',
                'bill_of_landing_non_inventories.country_id_origin',
                'bill_of_landing_non_inventories.country_id_bltb_released',
                'bill_of_landing_non_inventories.igm_india_voyage_id',
                'bill_of_landing_non_inventories.voyage_number',
                'bill_of_landing_non_inventories.ocean_freight',
                'bill_of_landing_non_inventories.country_id_ocefrepayable',
                'bill_of_landing_non_inventories.traffic_mode_id',
                'bill_of_landing_non_inventories.no_of_bls',
                'bill_of_landing_non_inventories.bl_type',
                'bill_of_landing_non_inventories.special_instructions',
                'bill_of_landing_non_inventories.shipper_loaded',
                'bill_of_landing_non_inventories.status_1',
                'bill_of_landing_non_inventories.status_2',
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
            ->join('booking_confirmations', 'bill_of_landing_non_inventories.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('clients as shipper', 'bill_of_landing_non_inventories.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'bill_of_landing_non_inventories.client_id_consignee', '=', 'consignee.id')
            ->join('clients as fw_agent', 'bill_of_landing_non_inventories.client_id_fw_agent', '=', 'fw_agent.id')
            ->join('clients as notify', 'bill_of_landing_non_inventories.client_id_notify', '=', 'notify.id')
            ->join('ports as portloading', 'bill_of_landing_non_inventories.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'bill_of_landing_non_inventories.port_id_discharge', '=', 'discharge.id')
            ->join('ports as final_dest', 'bill_of_landing_non_inventories.port_id_final_dest', '=', 'final_dest.id')
            ->join('ports as loading_bl', 'bill_of_landing_non_inventories.port_id_loading_bl', '=', 'loading_bl.id')
            ->join('ports as discharge_bl', 'bill_of_landing_non_inventories.port_id_discharge_bl', '=', 'discharge_bl.id')
            ->join('ports as final_dest_bl', 'bill_of_landing_non_inventories.port_id_final_dest_bl', '=', 'final_dest_bl.id')
            ->join('countries as origin', 'bill_of_landing_non_inventories.country_id_origin', '=', 'origin.id')
            ->join('countries as bltb_released', 'bill_of_landing_non_inventories.country_id_bltb_released', '=', 'bltb_released.id')
            ->join('countries as ocefrepayable', 'bill_of_landing_non_inventories.country_id_ocefrepayable', '=', 'ocefrepayable.id')
            ->join('traffic_modes', 'bill_of_landing_non_inventories.traffic_mode_id', '=', 'traffic_modes.id')
            ->where('bill_of_landing_non_inventories.id', '=', $id)
            ->get();

        return $bl_non_inventories;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create
            $this->validate($request, [
                'bill_of_landing_number' => 'unique:bill_of_landing_non_inventories,bill_of_landing_number'
            ]);


            $billoflandingnoninventories = new bill_of_landing_non_inventories();
        } else { // update


            $this->validate($request, [
                'bill_of_landing_number' => 'unique:bill_of_landing_non_inventories,bill_of_landing_number,' . $id
            ]);


            $billoflandingnoninventories = bill_of_landing_non_inventories::find($id);
        }

        try {
            $billoflandingnoninventories->date = $request->date;
            $billoflandingnoninventories->bill_of_landing_number = $request->bill_of_landing_number;
            $billoflandingnoninventories->booking_confirmation_id = $request->booking_confirmation_id;
            $billoflandingnoninventories->client_id_shipper = $request->client_id_shipper;
            $billoflandingnoninventories->export_references = $request->export_references;
            $billoflandingnoninventories->client_id_consignee = $request->client_id_consignee;
            $billoflandingnoninventories->client_id_fw_agent = $request->client_id_fw_agent;
            $billoflandingnoninventories->client_id_notify = $request->client_id_notify;
            $billoflandingnoninventories->port_id_loading = $request->port_id_loading;
            $billoflandingnoninventories->port_id_discharge = $request->port_id_discharge;
            $billoflandingnoninventories->port_id_final_dest = $request->port_id_final_dest;
            $billoflandingnoninventories->port_id_loading_bl = $request->port_id_loading_bl;
            $billoflandingnoninventories->port_id_discharge_bl = $request->port_id_discharge_bl;
            $billoflandingnoninventories->port_id_final_dest_bl = $request->port_id_final_dest_bl;
            $billoflandingnoninventories->detention_free_days = $request->detention_free_days;
            $billoflandingnoninventories->detention_description = $request->detention_description;
            $billoflandingnoninventories->pre_carriage_by = $request->pre_carriage_by;
            $billoflandingnoninventories->ship_on_board_date = $request->ship_on_board_date;
            $billoflandingnoninventories->country_id_origin = $request->country_id_origin;
            $billoflandingnoninventories->country_id_bltb_released = $request->country_id_bltb_released;
            $billoflandingnoninventories->igm_india_voyage_id = $request->igm_india_voyage_id;
            $billoflandingnoninventories->voyage_number = $request->voyage_number;
            $billoflandingnoninventories->ocean_freight = $request->ocean_freight;
            $billoflandingnoninventories->country_id_ocefrepayable = $request->country_id_ocefrepayable;
            $billoflandingnoninventories->traffic_mode_id = $request->traffic_mode_id;
            $billoflandingnoninventories->no_of_bls = $request->no_of_bls;
            $billoflandingnoninventories->bl_type = $request->bl_type;
            $billoflandingnoninventories->special_instructions = $request->special_instructions;
            $billoflandingnoninventories->shipper_loaded = $request->shipper_loaded;
            $billoflandingnoninventories->status_1 = $request->status_1;
            $billoflandingnoninventories->status_2 = $request->status_2;
            $billoflandingnoninventories->save();

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
