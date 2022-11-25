<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_switches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSwitchesController extends Controller
{
    public function index()
    {
        $billoflandingswitch = DB::table('bill_of_landing_switches')
            ->select(
                'bill_of_landing_switches.id',
                'bill_of_landing_switches.date',
                'bill_of_landing_switches.bill_of_landing_number',
                'bill_of_landing_switches.booking_confirmation_id',
                'bill_of_landing_switches.client_id_shipper',
                'bill_of_landing_switches.export_references',
                'bill_of_landing_switches.client_id_consignee',
                'bill_of_landing_switches.client_id_fw_agent',
                'bill_of_landing_switches.client_id_notify',
                'bill_of_landing_switches.port_id_loading',
                'bill_of_landing_switches.port_id_discharge',
                'bill_of_landing_switches.port_id_final_dest',
                'bill_of_landing_switches.detention_free_days',
                'bill_of_landing_switches.detention_description',
                'bill_of_landing_switches.pre_carriage_by',
                'bill_of_landing_switches.place_of_receipt',
                'bill_of_landing_switches.ship_on_board_date',
                'bill_of_landing_switches.country_id_origin',
                'bill_of_landing_switches.country_id_bltb_released',
                'bill_of_landing_switches.igm_india_voyage_id',
                'bill_of_landing_switches.voyage_number',
                'bill_of_landing_switches.ocean_freight',
                'bill_of_landing_switches.country_id_ocefrepayable',
                'bill_of_landing_switches.traffic_mode_id',
                'bill_of_landing_switches.no_of_bls',
                'bill_of_landing_switches.bl_type',
                'bill_of_landing_switches.special_instructions',
                'bill_of_landing_switches.shipper_loaded',
                'bill_of_landing_switches.status_1',
                'bill_of_landing_switches.status_2',
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
                'origin.country_name',
                'bltb_released.country_name',
                'ocefrepayable.country_name',
                'traffic_modes.trafficmode_type'
            )
            ->join('booking_confirmations', 'bill_of_landing_switches.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('clients as shipper', 'bill_of_landing_switches.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'bill_of_landing_switches.client_id_consignee', '=', 'consignee.id')
            ->join('clients as fw_agent', 'bill_of_landing_switches.client_id_fw_agent', '=', 'fw_agent.id')
            ->join('clients as notify', 'bill_of_landing_switches.client_id_notify', '=', 'notify.id')
            ->join('ports as portloading', 'bill_of_landing_switches.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'bill_of_landing_switches.port_id_discharge', '=', 'discharge.id')
            ->join('ports as final_dest', 'bill_of_landing_switches.port_id_final_dest', '=', 'final_dest.id')
            ->join('countries as origin', 'bill_of_landing_switches.country_id_origin', '=', 'origin.id')
            ->join('countries as bltb_released', 'bill_of_landing_switches.country_id_bltb_released', '=', 'bltb_released.id')
            ->join('countries as ocefrepayable', 'bill_of_landing_switches.country_id_ocefrepayable', '=', 'ocefrepayable.id')
            ->join('traffic_modes', 'bill_of_landing_switches.traffic_mode_id', '=', 'traffic_modes.id')
            ->paginate(50);

        return $billoflandingswitch;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingswitch = DB::table('bill_of_landing_switches')
            ->select(
                'bill_of_landing_switches.id',
                'bill_of_landing_switches.date',
                'bill_of_landing_switches.bill_of_landing_number',
                'bill_of_landing_switches.booking_confirmation_id',
                'bill_of_landing_switches.client_id_shipper',
                'bill_of_landing_switches.export_references',
                'bill_of_landing_switches.client_id_consignee',
                'bill_of_landing_switches.client_id_fw_agent',
                'bill_of_landing_switches.client_id_notify',
                'bill_of_landing_switches.port_id_loading',
                'bill_of_landing_switches.port_id_discharge',
                'bill_of_landing_switches.port_id_final_dest',
                'bill_of_landing_switches.detention_free_days',
                'bill_of_landing_switches.detention_description',
                'bill_of_landing_switches.pre_carriage_by',
                'bill_of_landing_switches.place_of_receipt',
                'bill_of_landing_switches.ship_on_board_date',
                'bill_of_landing_switches.country_id_origin',
                'bill_of_landing_switches.country_id_bltb_released',
                'bill_of_landing_switches.igm_india_voyage_id',
                'bill_of_landing_switches.voyage_number',
                'bill_of_landing_switches.ocean_freight',
                'bill_of_landing_switches.country_id_ocefrepayable',
                'bill_of_landing_switches.traffic_mode_id',
                'bill_of_landing_switches.no_of_bls',
                'bill_of_landing_switches.bl_type',
                'bill_of_landing_switches.special_instructions',
                'bill_of_landing_switches.shipper_loaded',
                'bill_of_landing_switches.status_1',
                'bill_of_landing_switches.status_2',
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
                'origin.country_name',
                'bltb_released.country_name',
                'ocefrepayable.country_name',
                'traffic_modes.trafficmode_type'
            )
            ->join('booking_confirmations', 'bill_of_landing_switches.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('clients as shipper', 'bill_of_landing_switches.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'bill_of_landing_switches.client_id_consignee', '=', 'consignee.id')
            ->join('clients as fw_agent', 'bill_of_landing_switches.client_id_fw_agent', '=', 'fw_agent.id')
            ->join('clients as notify', 'bill_of_landing_switches.client_id_notify', '=', 'notify.id')
            ->join('ports as portloading', 'bill_of_landing_switches.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'bill_of_landing_switches.port_id_discharge', '=', 'discharge.id')
            ->join('ports as final_dest', 'bill_of_landing_switches.port_id_final_dest', '=', 'final_dest.id')
            ->join('countries as origin', 'bill_of_landing_switches.country_id_origin', '=', 'origin.id')
            ->join('countries as bltb_released', 'bill_of_landing_switches.country_id_bltb_released', '=', 'bltb_released.id')
            ->join('countries as ocefrepayable', 'bill_of_landing_switches.country_id_ocefrepayable', '=', 'ocefrepayable.id')
            ->join('traffic_modes', 'bill_of_landing_switches.traffic_mode_id', '=', 'traffic_modes.id')
            ->where('bill_of_landing_switches.id', '=', $id)
            ->get();

        return $billoflandingswitch;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $billoflandingswitch = DB::table('bill_of_landing_switches')
                ->select(
                    'bill_of_landing_switches.id',
                    'bill_of_landing_switches.date',
                    'bill_of_landing_switches.bill_of_landing_number',
                    'bill_of_landing_switches.booking_confirmation_id',
                    'bill_of_landing_switches.client_id_shipper',
                    'bill_of_landing_switches.export_references',
                    'bill_of_landing_switches.client_id_consignee',
                    'bill_of_landing_switches.client_id_fw_agent',
                    'bill_of_landing_switches.client_id_notify',
                    'bill_of_landing_switches.port_id_loading',
                    'bill_of_landing_switches.port_id_discharge',
                    'bill_of_landing_switches.port_id_final_dest',
                    'bill_of_landing_switches.detention_free_days',
                    'bill_of_landing_switches.detention_description',
                    'bill_of_landing_switches.pre_carriage_by',
                    'bill_of_landing_switches.place_of_receipt',
                    'bill_of_landing_switches.ship_on_board_date',
                    'bill_of_landing_switches.country_id_origin',
                    'bill_of_landing_switches.country_id_bltb_released',
                    'bill_of_landing_switches.igm_india_voyage_id',
                    'bill_of_landing_switches.voyage_number',
                    'bill_of_landing_switches.ocean_freight',
                    'bill_of_landing_switches.country_id_ocefrepayable',
                    'bill_of_landing_switches.traffic_mode_id',
                    'bill_of_landing_switches.no_of_bls',
                    'bill_of_landing_switches.bl_type',
                    'bill_of_landing_switches.special_instructions',
                    'bill_of_landing_switches.shipper_loaded',
                    'bill_of_landing_switches.status_1',
                    'bill_of_landing_switches.status_2',
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
                    'origin.country_name',
                    'bltb_released.country_name',
                    'ocefrepayable.country_name',
                    'traffic_modes.trafficmode_type'
                )
                ->join('booking_confirmations', 'bill_of_landing_switches.booking_confirmation_id', '=', 'booking_confirmations.id')
                ->join('clients as shipper', 'bill_of_landing_switches.client_id_shipper', '=', 'shipper.id')
                ->join('clients as consignee', 'bill_of_landing_switches.client_id_consignee', '=', 'consignee.id')
                ->join('clients as fw_agent', 'bill_of_landing_switches.client_id_fw_agent', '=', 'fw_agent.id')
                ->join('clients as notify', 'bill_of_landing_switches.client_id_notify', '=', 'notify.id')
                ->join('ports as portloading', 'bill_of_landing_switches.port_id_loading', '=', 'portloading.id')
                ->join('ports as discharge', 'bill_of_landing_switches.port_id_discharge', '=', 'discharge.id')
                ->join('ports as final_dest', 'bill_of_landing_switches.port_id_final_dest', '=', 'final_dest.id')
                ->join('countries as origin', 'bill_of_landing_switches.country_id_origin', '=', 'origin.id')
                ->join('countries as bltb_released', 'bill_of_landing_switches.country_id_bltb_released', '=', 'bltb_released.id')
                ->join('countries as ocefrepayable', 'bill_of_landing_switches.country_id_ocefrepayable', '=', 'ocefrepayable.id')
                ->join('traffic_modes', 'bill_of_landing_switches.traffic_mode_id', '=', 'traffic_modes.id')
                ->where(function ($q) use ($query) {
                    $q->where('bill_of_landing_switches.bill_of_landing_number', 'like', '%' . $query . '%')
                        ->orWhere('shipper.client_code', 'like', '%' . $query . '%')
                        ->orWhere('shipper.client_name', 'like', '%' . $query . '%')
                        ->orWhere('consignee.client_code', 'like', '%' . $query . '%')
                        ->orWhere('consignee.client_name', 'like', '%' . $query . '%')
                        ->orWhere('fw_agent.client_code', 'like', '%' . $query . '%')
                        ->orWhere('fw_agent.client_name', 'like', '%' . $query . '%')
                        ->orWhere('notify.client_code', 'like', '%' . $query . '%')
                        ->orWhere('notify.client_name', 'like', '%' . $query . '%')
                        ->orWhere('portloading.port_code', 'like', '%' . $query . '%')
                        ->orWhere('portloading.port_name', 'like', '%' . $query . '%')
                        ->orWhere('discharge.port_code', 'like', '%' . $query . '%')
                        ->orWhere('discharge.port_name', 'like', '%' . $query . '%')
                        ->orWhere('final_dest.port_code', 'like', '%' . $query . '%')
                        ->orWhere('final_dest.port_name', 'like', '%' . $query . '%')
                        ->orWhere('origin.country_name', 'like', '%' . $query . '%')
                        ->orWhere('ocefrepayable.country_name', 'like', '%' . $query . '%')
                        ->orWhere('traffic_modes.trafficmode_type', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $billoflandingswitch;
    }

    public function showByFilter(Request $request)
    {
        // $fdate = isset($request->fdate) ? $request->fdate : date('Y-m-d');
        // $tdate = isset($request->tdate) ? $request->tdate : date('Y-m-d');

        // $billoflandingswitch = DB::table('bill_of_landing_switches')
        //     ->select(
        //         'bill_of_landing_switches.id',
        //         'bill_of_landing_switches.date',
        //         'bill_of_landing_switches.bill_of_landing_number',
        //         'bill_of_landing_switches.booking_confirmation_id',
        //         'bill_of_landing_switches.client_id_shipper',
        //         'bill_of_landing_switches.export_references',
        //         'bill_of_landing_switches.client_id_consignee',
        //         'bill_of_landing_switches.client_id_fw_agent',
        //         'bill_of_landing_switches.client_id_notify',
        //         'bill_of_landing_switches.port_id_loading',
        //         'bill_of_landing_switches.port_id_discharge',
        //         'bill_of_landing_switches.port_id_final_dest',
        //         'bill_of_landing_switches.detention_free_days',
        //         'bill_of_landing_switches.detention_description',
        //         'bill_of_landing_switches.pre_carriage_by',
        //         'bill_of_landing_switches.place_of_receipt',
        //         'bill_of_landing_switches.ship_on_board_date',
        //         'bill_of_landing_switches.country_id_origin',
        //         'bill_of_landing_switches.country_id_bltb_released',
        //         'bill_of_landing_switches.igm_india_voyage_id',
        //         'bill_of_landing_switches.voyage_number',
        //         'bill_of_landing_switches.ocean_freight',
        //         'bill_of_landing_switches.country_id_ocefrepayable',
        //         'bill_of_landing_switches.traffic_mode_id',
        //         'bill_of_landing_switches.no_of_bls',
        //         'bill_of_landing_switches.bl_type',
        //         'bill_of_landing_switches.special_instructions',
        //         'bill_of_landing_switches.shipper_loaded',
        //         'bill_of_landing_switches.status_1',
        //         'bill_of_landing_switches.status_2',
        //         'shipper.client_code',
        //         'shipper.client_name',
        //         'consignee.client_code',
        //         'consignee.client_name',
        //         'fw_agent.client_code',
        //         'fw_agent.client_name',
        //         'notify.client_code',
        //         'notify.client_name',
        //         'portloading.port_code',
        //         'portloading.port_name',
        //         'discharge.port_code',
        //         'discharge.port_name',
        //         'final_dest.port_code',
        //         'final_dest.port_name',
        //         'origin.country_name',
        //         'bltb_released.country_name',
        //         'ocefrepayable.country_name',
        //         'traffic_modes.trafficmode_type'
        //     )
        //     ->join('booking_confirmations', 'bill_of_landing_switches.booking_confirmation_id', '=', 'booking_confirmations.id')
        //     ->join('clients as shipper', 'bill_of_landing_switches.client_id_shipper', '=', 'shipper.id')
        //     ->join('clients as consignee', 'bill_of_landing_switches.client_id_consignee', '=', 'consignee.id')
        //     ->join('clients as fw_agent', 'bill_of_landing_switches.client_id_fw_agent', '=', 'fw_agent.id')
        //     ->join('clients as notify', 'bill_of_landing_switches.client_id_notify', '=', 'notify.id')
        //     ->join('ports as portloading', 'bill_of_landing_switches.port_id_loading', '=', 'portloading.id')
        //     ->join('ports as discharge', 'bill_of_landing_switches.port_id_discharge', '=', 'discharge.id')
        //     ->join('ports as final_dest', 'bill_of_landing_switches.port_id_final_dest', '=', 'final_dest.id')
        //     ->join('countries as origin', 'bill_of_landing_switches.country_id_origin', '=', 'origin.id')
        //     ->join('countries as bltb_released', 'bill_of_landing_switches.country_id_bltb_released', '=', 'bltb_released.id')
        //     ->join('countries as ocefrepayable', 'bill_of_landing_switches.country_id_ocefrepayable', '=', 'ocefrepayable.id')
        //     ->join('traffic_modes', 'bill_of_landing_switches.traffic_mode_id', '=', 'traffic_modes.id')
        //     ->where(DB::raw('DATE_FORMAT(bill_of_landing_switches.date, "%Y-%m-%d")'), '>=', $fdate)
        //     ->where(DB::raw('DATE_FORMAT(bill_of_landing_switches.date, "%Y-%m-%d")'), '<=', $tdate);

        // if (!empty($request->access_model_id) && empty($request->id) && !empty($request->access_model_id) && empty($request->id)) {
        //     // return "1";
        //     // id empty
        //      $accesspoints = $accesspoints
        //      ->where('access_models.id', '=', $request->access_model_id);
        // }
        // elseif (empty($request->access_model_id) && !empty($request->id)) {
        //     // return "2";
        //     // access_model_id empty
        //     $accesspoints = $accesspoints->where('access_points.id', '=', $request->id);
        // }
        // elseif (!empty($request->access_model_id) && !empty($request->id)) {
        //     // return "3";
        //     // no empty
        //     $accesspoints = $accesspoints
        //     ->where('access_models.id', '=', $request->access_model_id)
        //     ->where('access_points.id', '=', $request->id);
        // }
        // else
        // {
        //     // return "4";
        //     //all empty
        //     $accesspoints = $accesspoints;
        // }

        // $result = $accesspoints->orderBy('access_points.id')
        //     ->get();
        // return $result;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'bill_of_landing_number' => 'unique:bill_of_landing_switches,bill_of_landing_number'
            ]);



            $billoflandingswitch = new bill_of_landing_switches();
        } else { // update

            $this->validate($request, [
                'bill_of_landing_number' => 'unique:bill_of_landing_switches,bill_of_landing_number,' . $id,
            ]);

            $billoflandingswitch = bill_of_landing_switches::find($id);
        }


        try {
            $billoflandingswitch->date = $request->date;
            $billoflandingswitch->bill_of_landing_number = $request->bill_of_landing_number;
            $billoflandingswitch->booking_confirmation_id = $request->booking_confirmation_id;
            $billoflandingswitch->client_id_shipper = $request->client_id_shipper;
            $billoflandingswitch->export_references = $request->export_references;
            $billoflandingswitch->client_id_consignee = $request->client_id_consignee;
            $billoflandingswitch->client_id_fw_agent = $request->client_id_fw_agent;
            $billoflandingswitch->client_id_notify = $request->client_id_notify;
            $billoflandingswitch->port_id_loading = $request->port_id_loading;
            $billoflandingswitch->port_id_discharge = $request->port_id_discharge;
            $billoflandingswitch->port_id_final_dest = $request->port_id_final_dest;
            $billoflandingswitch->detention_free_days = $request->detention_free_days;
            $billoflandingswitch->detention_description = $request->detention_description;
            $billoflandingswitch->pre_carriage_by = $request->pre_carriage_by;
            $billoflandingswitch->place_of_receipt = $request->place_of_receipt;
            $billoflandingswitch->ship_on_board_date = $request->ship_on_board_date;
            $billoflandingswitch->export_references = $request->export_references;
            $billoflandingswitch->country_id_origin = $request->country_id_origin;
            $billoflandingswitch->country_id_bltb_released = $request->country_id_bltb_released;
            $billoflandingswitch->igm_india_voyage_id = $request->igm_india_voyage_id;
            $billoflandingswitch->voyage_number = $request->voyage_number;
            $billoflandingswitch->ocean_freight = $request->ocean_freight;
            $billoflandingswitch->country_id_ocefrepayable = $request->country_id_ocefrepayable;
            $billoflandingswitch->traffic_mode_id = $request->traffic_mode_id;
            $billoflandingswitch->no_of_bls = $request->no_of_bls;
            $billoflandingswitch->bl_type = $request->bl_type;
            $billoflandingswitch->special_instructions = $request->special_instructions;
            $billoflandingswitch->shipper_loaded = $request->shipper_loaded;
            $billoflandingswitch->status_1 = $request->status_1;
            $billoflandingswitch->status_2 = $request->status_2;
            $billoflandingswitch->save();

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
