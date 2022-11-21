<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_sub_non_inventories_exps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSubNonInventoriesExpsController extends Controller
{
    public function index()
    {
        $billoflandingsubnoninventoriesexps = DB::table('bill_of_landing_sub_non_inventories_exps')
            ->select(
                'bill_of_landing_sub_non_inventories_exps.id',
                'bill_of_landing_sub_non_inventories_exps.blsn_invent_id',
                'bill_of_landing_sub_non_inventories_exps.ex_bc_id',
                'bill_of_landing_sub_non_inventories_exps.ex_reserved_date',
                'bill_of_landing_sub_non_inventories_exps.ex_shipper_date',
                'bill_of_landing_sub_non_inventories_exps.exp_freight_charge',
                'bill_of_landing_sub_non_inventories_exps.exp_dc_surcharge_in',
                'bill_of_landing_sub_non_inventories_exps.exp_other_recovery',
                'bill_of_landing_sub_non_inventories_exps.exp_other_recovery_remarks',
                'bill_of_landing_sub_non_inventories_exps.exp_total_in',
                'bill_of_landing_sub_non_inventories_exps.exp_slot_fees',
                'bill_of_landing_sub_non_inventories_exps.exp_dc_surcharge_ex',
                'bill_of_landing_sub_non_inventories_exps.exp_agent_comm',
                'bill_of_landing_sub_non_inventories_exps.exp_phc',
                'bill_of_landing_sub_non_inventories_exps.exp_total_expenses',
                'bill_of_landing_sub_non_inventories_exps.exp_final_amount',
                'bill_of_landing_sub_non_inventories_exps.exp_remarks',
                'bill_of_landing_sub_non_inventories_exps.exp_created_date',
                'bill_of_landing_sub_non_inventories_exps.exp_approved_by',
                'bill_of_landing_sub_non_inventories_exps.exp_approved_date',
                'booking_confirmations.booking_confirmation_number'
            )
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_non_inventories_exps.blsn_invent_id', '=', 'bill_of_landing_sub_non_inventories_exps.id')
            ->join('booking_confirmations', 'bill_of_landing_sub_non_inventories_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->paginate(50);

        return $billoflandingsubnoninventoriesexps;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubnoninventoriesexps = DB::table('bill_of_landing_sub_non_inventories_exps')
            ->select(
                'bill_of_landing_sub_non_inventories_exps.id',
                'bill_of_landing_sub_non_inventories_exps.blsn_invent_id',
                'bill_of_landing_sub_non_inventories_exps.ex_bc_id',
                'bill_of_landing_sub_non_inventories_exps.ex_reserved_date',
                'bill_of_landing_sub_non_inventories_exps.ex_shipper_date',
                'bill_of_landing_sub_non_inventories_exps.exp_freight_charge',
                'bill_of_landing_sub_non_inventories_exps.exp_dc_surcharge_in',
                'bill_of_landing_sub_non_inventories_exps.exp_other_recovery',
                'bill_of_landing_sub_non_inventories_exps.exp_other_recovery_remarks',
                'bill_of_landing_sub_non_inventories_exps.exp_total_in',
                'bill_of_landing_sub_non_inventories_exps.exp_slot_fees',
                'bill_of_landing_sub_non_inventories_exps.exp_dc_surcharge_ex',
                'bill_of_landing_sub_non_inventories_exps.exp_agent_comm',
                'bill_of_landing_sub_non_inventories_exps.exp_phc',
                'bill_of_landing_sub_non_inventories_exps.exp_total_expenses',
                'bill_of_landing_sub_non_inventories_exps.exp_final_amount',
                'bill_of_landing_sub_non_inventories_exps.exp_remarks',
                'bill_of_landing_sub_non_inventories_exps.exp_created_date',
                'bill_of_landing_sub_non_inventories_exps.exp_approved_by',
                'bill_of_landing_sub_non_inventories_exps.exp_approved_date',
                'booking_confirmations.booking_confirmation_number'
            )
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_non_inventories_exps.blsn_invent_id', '=', 'bill_of_landing_sub_non_inventories_exps.id')
            ->join('booking_confirmations', 'bill_of_landing_sub_non_inventories_exps.ex_bc_id', '=', 'booking_confirmations.id')
            ->where('bill_of_landing_sub_non_inventories.id', '=', $id)
            ->get();

        return $billoflandingsubnoninventoriesexps;
    }

    // public function showBySearch(Request $request)
    // {
    //     $query = "";

    //     if ($request->get('query')) {
    //         $query = $request->get('query');

    //         $billoflandingsubnoninventoriesexps = DB::table('bill_of_landing_sub_non_inventories_exps')
    //         ->select(
    //             'bill_of_landing_sub_non_inventories_exps.id',
    //             'bill_of_landing_sub_non_inventories_exps.blsn_invent_id',
    //             'bill_of_landing_sub_non_inventories_exps.ex_bc_id',
    //             'bill_of_landing_sub_non_inventories_exps.ex_reserved_date',
    //             'bill_of_landing_sub_non_inventories_exps.ex_shipper_date',
    //             'bill_of_landing_sub_non_inventories_exps.exp_freight_charge',
    //             'bill_of_landing_sub_non_inventories_exps.exp_dc_surcharge_in',
    //             'bill_of_landing_sub_non_inventories_exps.exp_other_recovery',
    //             'bill_of_landing_sub_non_inventories_exps.exp_other_recovery_remarks',
    //             'bill_of_landing_sub_non_inventories_exps.exp_total_in',
    //             'bill_of_landing_sub_non_inventories_exps.exp_slot_fees',
    //             'bill_of_landing_sub_non_inventories_exps.exp_dc_surcharge_ex',
    //             'bill_of_landing_sub_non_inventories_exps.exp_agent_comm',
    //             'bill_of_landing_sub_non_inventories_exps.exp_phc',
    //             'bill_of_landing_sub_non_inventories_exps.exp_total_expenses',
    //             'bill_of_landing_sub_non_inventories_exps.exp_final_amount',
    //             'bill_of_landing_sub_non_inventories_exps.exp_remarks',
    //             'bill_of_landing_sub_non_inventories_exps.exp_created_date',
    //             'bill_of_landing_sub_non_inventories_exps.exp_approved_by',
    //             'bill_of_landing_sub_non_inventories_exps.exp_approved_date',
    //             'booking_confirmations.booking_confirmation_number'
    //         )
    //         ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_non_inventories_exps.blsn_invent_id', '=', 'bill_of_landing_sub_non_inventories_exps.id')
    //         ->join('booking_confirmations', 'bill_of_landing_sub_non_inventories_exps.ex_bc_id', '=', 'booking_confirmations.id')
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

            $blsnoninventoriesexps = new bill_of_landing_sub_non_inventories_exps();
        } else { // update

            $blsnoninventoriesexps = bill_of_landing_sub_non_inventories_exps::find($id);
        }


        try {
            $blsnoninventoriesexps->blsn_invent_id = $request->blsn_invent_id;
            $blsnoninventoriesexps->ex_bc_id = $request->ex_bc_id;
            $blsnoninventoriesexps->ex_reserved_date = $request->ex_reserved_date;
            $blsnoninventoriesexps->ex_shipper_date = $request->ex_shipper_date;
            $blsnoninventoriesexps->exp_freight_charge = $request->exp_freight_charge;
            $blsnoninventoriesexps->exp_dc_surcharge_in = $request->exp_dc_surcharge_in;
            $blsnoninventoriesexps->exp_other_recovery = $request->exp_other_recovery;
            $blsnoninventoriesexps->exp_other_recovery_remarks = $request->exp_other_recovery_remarks;
            $blsnoninventoriesexps->exp_total_in = $request->exp_total_in;
            $blsnoninventoriesexps->exp_slot_fees = $request->exp_slot_fees;
            $blsnoninventoriesexps->exp_dc_surcharge_ex = $request->exp_dc_surcharge_ex;
            $blsnoninventoriesexps->exp_phc = $request->exp_phc;
            $blsnoninventoriesexps->exp_total_expenses = $request->exp_total_expenses;
            $blsnoninventoriesexps->exp_final_amount = $request->exp_final_amount;
            $blsnoninventoriesexps->exp_remarks = $request->exp_remarks;
            $blsnoninventoriesexps->exp_created_date = $request->exp_created_date;
            $blsnoninventoriesexps->exp_approved_by = $request->exp_approved_by;
            $blsnoninventoriesexps->exp_approved_date = $request->exp_approved_date;
            $blsnoninventoriesexps->save();

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
