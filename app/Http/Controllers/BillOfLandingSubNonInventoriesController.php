<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_sub_non_inventories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSubNonInventoriesController extends Controller
{
    public function index()
    {
        $billoflandingsubnoninventories = DB::table('bill_of_landing_sub_non_inventories')
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
                'traffic_modes.trafficmode_type',
                'igm_india_voyages.voyage',
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
            ->join('igm_india_voyages', 'detention_invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->get();

        return $billoflandingsubnoninventories;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubnoninventories = DB::table('bill_of_landing_sub_non_inventories')
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
                'traffic_modes.trafficmode_type',
                'igm_india_voyages.voyage',
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
            ->join('igm_india_voyages', 'detention_invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->where('clients.id', '=', $id)
            ->get();

        return $billoflandingsubnoninventories;
    }

    public function store(Request $request)
    {
        $id = $request->id;


        $billoflandingsubnoninventory = new bill_of_landing_sub_non_inventories();


        try {
            $billoflandingsubnoninventory->bill_of_landing_id = $request->bill_of_landing_id;
            $billoflandingsubnoninventory->booking_confirmation_id = $request->booking_confirmation_id;
            $billoflandingsubnoninventory->equipment_id = $request->equipment_id;
            $billoflandingsubnoninventory->seal_no = $request->seal_no;
            $billoflandingsubnoninventory->marks = $request->marks;
            $billoflandingsubnoninventory->package_quantity = $request->package_quantity;
            $billoflandingsubnoninventory->description = $request->description;
            $billoflandingsubnoninventory->gross_weight = $request->gross_weight;
            $billoflandingsubnoninventory->measurement = $request->measurement;
            $billoflandingsubnoninventory->bill_confirmation_id = $request->bill_confirmation_id;
            $billoflandingsubnoninventory->status = $request->status;
            $billoflandingsubnoninventory->ignore_data = $request->ignore_data;
            $billoflandingsubnoninventory->reserved_date = $request->reserved_date;
            $billoflandingsubnoninventory->shipper_date = $request->shipper_date;
            $billoflandingsubnoninventory->on_job_date = $request->on_job_date;
            $billoflandingsubnoninventory->yard_in_date = $request->yard_in_date;
            $billoflandingsubnoninventory->client_id_agent = $request->client_id_agent;
            $billoflandingsubnoninventory->client_id_ex_agent = $request->client_id_ex_agent;
            $billoflandingsubnoninventory->vendor_id_yard = $request->vendor_id_yard;
            $billoflandingsubnoninventory->free_days = $request->free_days;
            $billoflandingsubnoninventory->free_days_standard = $request->free_days_standard;
            $billoflandingsubnoninventory->ata_fpd = $request->ata_fpd;
            $billoflandingsubnoninventory->payed_till = $request->payed_till;
            $billoflandingsubnoninventory->soa_status_exp = $request->soa_status_exp;
            $billoflandingsubnoninventory->soa_status_imp = $request->soa_status_imp;
            $billoflandingsubnoninventory->lift_on_off = $request->lift_on_off;
            $billoflandingsubnoninventory->other_expenses = $request->other_expenses;
            $billoflandingsubnoninventory->other_expenses_remarks = $request->other_expenses_remarks;
            $billoflandingsubnoninventory->deleted = $request->deleted;
            $billoflandingsubnoninventory->save();

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
