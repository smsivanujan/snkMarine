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
                'bill_of_landing_sub_switches_exps.blsn_invent_id',
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
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_switches_exps.blsn_invent_id', '=', 'bill_of_landing_sub_switches_exps.id')
            ->join('booking_confirmations', 'bill_of_landing_sub_switches_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->get();

        return $billoflandingsubswitchesexps;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubswitchesexps = DB::table('bill_of_landing_sub_switches_exps')
            ->select(
                'bill_of_landing_sub_switches_exps.id',
                'bill_of_landing_sub_switches_exps.blsn_invent_id',
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
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_switches_exps.blsn_invent_id', '=', 'bill_of_landing_sub_switches_exps.id')
            ->join('booking_confirmations', 'bill_of_landing_sub_switches_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->where('bill_of_landing_sub_non_inventories.id', '=', $id)
            ->get();

        return $billoflandingsubswitchesexps;
    }

    public function store(Request $request)
    {

            $bls_switches_exps = new bill_of_landing_sub_switches_exps();
        

        try {
            $bls_switches_exps->blsn_invent_id = $request->blsn_invent_id;
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
