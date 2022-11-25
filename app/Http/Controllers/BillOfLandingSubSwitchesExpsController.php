<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_sub_switches_exps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSubSwitchesExpsController extends Controller
{
    public function index()
    {
        $billoflandingsubswitchesexps = DB::table('bill_of_landing_sub_switches_exps')
            ->select(
                'bill_of_landing_sub_switches_exps.id',
                'bill_of_landing_sub_switches_exps.bls_switch_id',
                'bill_of_landing_sub_switches_exps.ex_bc_id',
                'bill_of_landing_sub_switches_exps.ex_reserved_date',
                'bill_of_landing_sub_switches_exps.ex_shipper_date',
                'bill_of_landing_sub_switches_exps.exp_freight_charge',
                'bill_of_landing_sub_switches_exps.exp_dc_surcharge_in',
                'bill_of_landing_sub_switches_exps.exp_other_recovery',
                'bill_of_landing_sub_switches_exps.exp_other_recovery_remarks',
                'bill_of_landing_sub_switches_exps.exp_total_in',
                'bill_of_landing_sub_switches_exps.exp_slot_fees',
                'bill_of_landing_sub_switches_exps.exp_dc_surcharge_ex',
                'bill_of_landing_sub_switches_exps.exp_agent_comm',
                'bill_of_landing_sub_switches_exps.exp_phc',
                'bill_of_landing_sub_switches_exps.exp_total_expenses',
                'bill_of_landing_sub_switches_exps.exp_final_amount',
                'bill_of_landing_sub_switches_exps.exp_remarks',
                'bill_of_landing_sub_switches_exps.exp_created_date',
                'bill_of_landing_sub_switches_exps.exp_approved_by',
                'bill_of_landing_sub_switches_exps.exp_approved_date',
                'booking_confirmations.booking_confirmation_number'
            )
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_switches_exps.bls_switch_id', '=', 'bill_of_landing_sub_switches_exps.id')
            ->join('booking_confirmations', 'bill_of_landing_sub_switches_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->paginate(50);

        return $billoflandingsubswitchesexps;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubswitchesexps = DB::table('bill_of_landing_sub_switches_exps')
            ->select(
                'bill_of_landing_sub_switches_exps.id',
                'bill_of_landing_sub_switches_exps.bls_switch_id',
                'bill_of_landing_sub_switches_exps.ex_bc_id',
                'bill_of_landing_sub_switches_exps.ex_reserved_date',
                'bill_of_landing_sub_switches_exps.ex_shipper_date',
                'bill_of_landing_sub_switches_exps.exp_freight_charge',
                'bill_of_landing_sub_switches_exps.exp_dc_surcharge_in',
                'bill_of_landing_sub_switches_exps.exp_other_recovery',
                'bill_of_landing_sub_switches_exps.exp_other_recovery_remarks',
                'bill_of_landing_sub_switches_exps.exp_total_in',
                'bill_of_landing_sub_switches_exps.exp_slot_fees',
                'bill_of_landing_sub_switches_exps.exp_dc_surcharge_ex',
                'bill_of_landing_sub_switches_exps.exp_agent_comm',
                'bill_of_landing_sub_switches_exps.exp_phc',
                'bill_of_landing_sub_switches_exps.exp_total_expenses',
                'bill_of_landing_sub_switches_exps.exp_final_amount',
                'bill_of_landing_sub_switches_exps.exp_remarks',
                'bill_of_landing_sub_switches_exps.exp_created_date',
                'bill_of_landing_sub_switches_exps.exp_approved_by',
                'bill_of_landing_sub_switches_exps.exp_approved_date',
                'booking_confirmations.booking_confirmation_number'
            )
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_switches_exps.bls_switch_id', '=', 'bill_of_landing_sub_switches_exps.id')
            ->join('booking_confirmations', 'bill_of_landing_sub_switches_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->where('bill_of_landing_sub_non_inventories.id', '=', $id)
            ->get();

        return $billoflandingsubswitchesexps;
    }

    public function showBySearch(Request $request)
    {
        // $query = "";

        // if ($request->get('query')) {
        //     $query = $request->get('query');

        //     $arrivalnoticecontainers = DB::table('arrival_notice_containers')
        //     ->select(
        //         'arrival_notice_containers.id',
        //         'arrival_notice_containers.arrival_notice_id',
        //         'arrival_notice_containers.equipment_id',
        //         'arrival_notice_containers.seal_no',
        //         'arrival_notice_containers.marks',
        //         'arrival_notice_containers.type_of_unit_id',
        //         'arrival_noticies.arrival_notice_no',
        //         'equipments.equipment_number',
        //         'type_of_units.type_of_unit',
        //     )
        //     ->join('arrival_noticies', 'arrival_notice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
        //     ->join('equipments', 'arrival_notice_containers.equipment_id', '=', 'equipments.id')
        //     ->join('type_of_units', 'arrival_notice_containers.type_of_unit_id', '=', 'type_of_units.id')
        //         ->where(function ($q) use ($query) {
        //             $q->where('arrival_noticies.arrival_notice_no', 'like', '%' . $query . '%')
        //                 ->orWhere('arrival_noticies.seal_no', 'like', '%' . $query . '%')
        //                 ->orWhere('equipments.equipment_number', 'like', '%' . $query . '%')
        //                 ->orWhere('type_of_units.type_of_unit', 'like', '%' . $query . '%');
        //         })
        //         ->get();
        // }

        // return $arrivalnoticecontainers;
    }


    public function store(Request $request)
    {
        $id = $request->id;
        if ($id == 0) { // create

            $bls_switches_exps = new bill_of_landing_sub_switches_exps();
        } else { // update

            $bls_switches_exps = bill_of_landing_sub_switches_exps::find($id);
        }


        try {
            $bls_switches_exps->bls_switch_id = $request->bls_switch_id;
            $bls_switches_exps->ex_bc_id = $request->ex_bc_id;
            $bls_switches_exps->ex_reserved_date = $request->ex_reserved_date;
            $bls_switches_exps->ex_shipper_date = $request->ex_shipper_date;
            $bls_switches_exps->exp_freight_charge = $request->exp_freight_charge;
            $bls_switches_exps->exp_dc_surcharge_in = $request->exp_dc_surcharge_in;
            $bls_switches_exps->exp_other_recovery = $request->exp_other_recovery;
            $bls_switches_exps->exp_other_recovery_remarks = $request->exp_other_recovery_remarks;
            $bls_switches_exps->exp_total_in = $request->exp_total_in;
            $bls_switches_exps->exp_slot_fees = $request->exp_slot_fees;
            $bls_switches_exps->exp_dc_surcharge_ex = $request->exp_dc_surcharge_ex;
            $bls_switches_exps->exp_agent_comm = $request->exp_agent_comm;
            $bls_switches_exps->exp_phc = $request->exp_phc;
            $bls_switches_exps->exp_total_expenses = $request->exp_total_expenses;
            $bls_switches_exps->exp_final_amount = $request->exp_final_amount;
            $bls_switches_exps->exp_remarks = $request->exp_remarks;
            $bls_switches_exps->exp_created_date = $request->exp_created_date;
            $bls_switches_exps->exp_approved_by = $request->exp_approved_by;
            $bls_switches_exps->exp_approved_date = $request->exp_approved_date;
            $bls_switches_exps->save();

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
