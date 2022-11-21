<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_subs;
use App\Models\bill_of_landing_subs_exps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSubsExpsController extends Controller
{
    public function index()
    {
        $billoflandingsubnoninventoriesexps = DB::table('bill_of_landing_subs_exps')
            ->select(
                'bill_of_landing_subs_exps.id',
                'bill_of_landing_subs_exps.bill_of_landing_sub_id',
                'bill_of_landing_subs_exps.ex_bc_id',
                'bill_of_landing_subs_exps.ex_reserved_date',
                'bill_of_landing_subs_exps.ex_shipper_date',
                'bill_of_landing_subs_exps.exp_freight_charge',
                'bill_of_landing_subs_exps.exp_dc_surcharge_in',
                'bill_of_landing_subs_exps.exp_other_recovery',
                'bill_of_landing_subs_exps.exp_other_recovery_remarks',
                'bill_of_landing_subs_exps.exp_total_in',
                'bill_of_landing_subs_exps.exp_slot_fees',
                'bill_of_landing_subs_exps.exp_dc_surcharge_ex',
                'bill_of_landing_subs_exps.exp_agent_comm',
                'bill_of_landing_subs_exps.exp_phc',
                'bill_of_landing_subs_exps.exp_total_expenses',
                'bill_of_landing_subs_exps.exp_final_amount',
                'bill_of_landing_subs_exps.exp_remarks',
                'bill_of_landing_subs_exps.exp_created_date',
                'bill_of_landing_subs_exps.exp_approved_by',
                'bill_of_landing_subs_exps.exp_approved_date',
                'booking_confirmations.booking_confirmation_number'
            )
            ->join('bill_of_landing_subs', 'bill_of_landing_subs_exps.bill_of_landing_sub_id', '=', 'bill_of_landing_subs.id')
            ->join('booking_confirmations', 'bill_of_landing_subs_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->paginate(50);

        return $billoflandingsubnoninventoriesexps;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubnoninventoriesexps = DB::table('bill_of_landing_subs_exps')
            ->select(
                'bill_of_landing_subs_exps.id',
                'bill_of_landing_subs_exps.bill_of_landing_sub_id',
                'bill_of_landing_subs_exps.ex_bc_id',
                'bill_of_landing_subs_exps.ex_reserved_date',
                'bill_of_landing_subs_exps.ex_shipper_date',
                'bill_of_landing_subs_exps.exp_freight_charge',
                'bill_of_landing_subs_exps.exp_dc_surcharge_in',
                'bill_of_landing_subs_exps.exp_other_recovery',
                'bill_of_landing_subs_exps.exp_other_recovery_remarks',
                'bill_of_landing_subs_exps.exp_total_in',
                'bill_of_landing_subs_exps.exp_slot_fees',
                'bill_of_landing_subs_exps.exp_dc_surcharge_ex',
                'bill_of_landing_subs_exps.exp_agent_comm',
                'bill_of_landing_subs_exps.exp_phc',
                'bill_of_landing_subs_exps.exp_total_expenses',
                'bill_of_landing_subs_exps.exp_final_amount',
                'bill_of_landing_subs_exps.exp_remarks',
                'bill_of_landing_subs_exps.exp_created_date',
                'bill_of_landing_subs_exps.exp_approved_by',
                'bill_of_landing_subs_exps.exp_approved_date',
                'booking_confirmations.booking_confirmation_number'
            )
            ->join('bill_of_landing_subs', 'bill_of_landing_subs_exps.bill_of_landing_sub_id', '=', 'bill_of_landing_subs.id')
            ->join('booking_confirmations', 'bill_of_landing_subs_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->where('bill_of_landing_subs_exps.id', '=', $id)
            ->get();

        return $billoflandingsubnoninventoriesexps;
    }

    // public function showBySearch(Request $request)
    // {
    //     $query = "";

    //     if ($request->get('query')) {
    //         $query = $request->get('query');

    //         $arrivalnoticecontainers = DB::table('arrival_notice_containers')
    //         ->select(
    //             'arrival_notice_containers.id',
    //             'arrival_notice_containers.arrival_notice_id',
    //             'arrival_notice_containers.equipment_id',
    //             'arrival_notice_containers.seal_no',
    //             'arrival_notice_containers.marks',
    //             'arrival_notice_containers.type_of_unit_id',
    //             'arrival_noticies.arrival_notice_no',
    //             'equipments.equipment_number',
    //             'type_of_units.type_of_unit',
    //         )
    //         ->join('arrival_noticies', 'arrival_notice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
    //         ->join('equipments', 'arrival_notice_containers.equipment_id', '=', 'equipments.id')
    //         ->join('type_of_units', 'arrival_notice_containers.type_of_unit_id', '=', 'type_of_units.id')
    //             ->where(function ($q) use ($query) {
    //                 $q->where('arrival_noticies.arrival_notice_no', 'like', '%' . $query . '%')
    //                     ->orWhere('arrival_noticies.seal_no', 'like', '%' . $query . '%')
    //                     ->orWhere('equipments.equipment_number', 'like', '%' . $query . '%')
    //                     ->orWhere('type_of_units.type_of_unit', 'like', '%' . $query . '%');
    //             })
    //             ->get();
    //     }

    //     return $arrivalnoticecontainers;
    // }


    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $billoflandingsubsexps = new bill_of_landing_subs_exps();
        } else { // update

            $billoflandingsubsexps = bill_of_landing_subs_exps::find($id);
        }


        try {
            $billoflandingsubsexps->bill_of_landing_sub_id = $request->bill_of_landing_sub_id;
            $billoflandingsubsexps->ex_bc_id = $request->ex_bc_id;
            $billoflandingsubsexps->ex_reserved_date = $request->ex_reserved_date;
            $billoflandingsubsexps->ex_shipper_date = $request->ex_shipper_date;
            $billoflandingsubsexps->exp_freight_charge = $request->exp_freight_charge;
            $billoflandingsubsexps->exp_dc_surcharge_in = $request->exp_dc_surcharge_in;
            $billoflandingsubsexps->exp_other_recovery = $request->exp_other_recovery;
            $billoflandingsubsexps->exp_other_recovery_remarks = $request->exp_other_recovery_remarks;
            $billoflandingsubsexps->exp_total_in = $request->exp_total_in;
            $billoflandingsubsexps->exp_slot_fees = $request->exp_slot_fees;
            $billoflandingsubsexps->exp_dc_surcharge_ex = $request->exp_dc_surcharge_ex;
            $billoflandingsubsexps->exp_agent_comm = $request->exp_agent_comm;
            $billoflandingsubsexps->exp_phc = $request->exp_phc;
            $billoflandingsubsexps->exp_total_expenses = $request->exp_total_expenses;
            $billoflandingsubsexps->exp_final_amount = $request->exp_final_amount;
            $billoflandingsubsexps->exp_remarks = $request->exp_remarks;
            $billoflandingsubsexps->exp_created_date = $request->exp_created_date;
            $billoflandingsubsexps->exp_approved_by = $request->exp_approved_by;
            $billoflandingsubsexps->exp_approved_date = $request->exp_approved_date;
            $billoflandingsubsexps->save();

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
