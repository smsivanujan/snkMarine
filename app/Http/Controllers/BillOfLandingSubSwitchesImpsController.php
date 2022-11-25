<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_sub_switches_imps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSubSwitchesImpsController extends Controller
{
    public function index()
    {
        $billoflandingsubswitchesimps = DB::table('bill_of_landing_sub_switches_imps')
            ->select(
                'bill_of_landing_sub_switches_imps.id',
                'bill_of_landing_sub_switches_imps.bls_switch_id',
                'bill_of_landing_sub_switches_imps.imp_freight_charge_in',
                'bill_of_landing_sub_switches_imps.imp_doc_fee',
                'bill_of_landing_sub_switches_imps.imp_thc_phc',
                'bill_of_landing_sub_switches_imps.exp_other_recovery',
                'bill_of_landing_sub_switches_imps.exp_other_recovery_remarks',
                'bill_of_landing_sub_switches_imps.exp_total_in',
                'bill_of_landing_sub_switches_imps.exp_agent_comm',
                'bill_of_landing_sub_switches_imps.exp_phc',
                'bill_of_landing_sub_switches_imps.imp_doc_charges',
                'bill_of_landing_sub_switches_imps.imp_freight_charge_ex',
                'bill_of_landing_sub_switches_imps.imp_dc_surcharge',
                'bill_of_landing_sub_switches_imps.imp_other_expenses',
                'bill_of_landing_sub_switches_imps.imp_other_expenses_remarks',
                'bill_of_landing_sub_switches_imps.imp_total_ex',
                'bill_of_landing_sub_switches_imps.imp_final_amount',
                'bill_of_landing_sub_switches_imps.imp_remarks'
            )
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_switches_imps.bls_switch_id', '=', 'bill_of_landing_sub_non_inventories.id')
            ->get();

        return $billoflandingsubswitchesimps;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubswitchesimps = DB::table('bill_of_landing_sub_switches_imps')
            ->select(
                'bill_of_landing_sub_switches_imps.id',
                'bill_of_landing_sub_switches_imps.bls_switch_id',
                'bill_of_landing_sub_switches_imps.imp_freight_charge_in',
                'bill_of_landing_sub_switches_imps.imp_doc_fee',
                'bill_of_landing_sub_switches_imps.imp_thc_phc',
                'bill_of_landing_sub_switches_imps.exp_other_recovery',
                'bill_of_landing_sub_switches_imps.exp_other_recovery_remarks',
                'bill_of_landing_sub_switches_imps.exp_total_in',
                'bill_of_landing_sub_switches_imps.exp_agent_comm',
                'bill_of_landing_sub_switches_imps.exp_phc',
                'bill_of_landing_sub_switches_imps.imp_doc_charges',
                'bill_of_landing_sub_switches_imps.imp_freight_charge_ex',
                'bill_of_landing_sub_switches_imps.imp_dc_surcharge',
                'bill_of_landing_sub_switches_imps.imp_other_expenses',
                'bill_of_landing_sub_switches_imps.imp_other_expenses_remarks',
                'bill_of_landing_sub_switches_imps.imp_total_ex',
                'bill_of_landing_sub_switches_imps.imp_final_amount',
                'bill_of_landing_sub_switches_imps.imp_remarks'
            )
            ->join('bill_of_landing_sub_non_inventories', 'bill_of_landing_sub_switches_imps.bls_switch_id', '=', 'bill_of_landing_sub_non_inventories.id')
            ->where('bill_of_landing_sub_switches_imps.id', '=', $id)
            ->paginate(50);

        return $billoflandingsubswitchesimps;
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

            $bls_switches_imps = new bill_of_landing_sub_switches_imps();
        } else { // update

            $bls_switches_imps = bill_of_landing_sub_switches_imps::find($id);
        }


        try {
            $bls_switches_imps->bls_switch_id = $request->bls_switch_id;
            $bls_switches_imps->imp_freight_charge_in = $request->imp_freight_charge_in;
            $bls_switches_imps->imp_doc_fee = $request->imp_doc_fee;
            $bls_switches_imps->imp_thc_phc = $request->imp_thc_phc;
            $bls_switches_imps->exp_other_recovery = $request->exp_other_recovery;
            $bls_switches_imps->exp_other_recovery_remarks = $request->exp_other_recovery_remarks;
            $bls_switches_imps->exp_total_in = $request->exp_total_in;
            $bls_switches_imps->exp_agent_comm = $request->exp_agent_comm;
            $bls_switches_imps->exp_phc = $request->exp_phc;
            $bls_switches_imps->imp_doc_charges = $request->imp_doc_charges;
            $bls_switches_imps->imp_freight_charge_ex = $request->imp_freight_charge_ex;
            $bls_switches_imps->imp_dc_surcharge = $request->imp_dc_surcharge;
            $bls_switches_imps->imp_other_expenses = $request->imp_other_expenses;
            $bls_switches_imps->imp_other_expenses_remarks = $request->imp_other_expenses_remarks;
            $bls_switches_imps->imp_total_ex = $request->imp_total_ex;
            $bls_switches_imps->imp_final_amount = $request->imp_final_amount;
            $bls_switches_imps->imp_remarks = $request->imp_remarks;
            $bls_switches_imps->imp_created_by = $request->imp_created_by;
            $bls_switches_imps->imp_created_date = $request->imp_created_date;
            $bls_switches_imps->imp_approved_by = $request->imp_approved_by;
            $bls_switches_imps->imp_approved_date = $request->imp_approved_date;
            $bls_switches_imps->save();


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
