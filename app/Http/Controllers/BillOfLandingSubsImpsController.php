<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_subs_imps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSubsImpsController extends Controller
{
    public function index()
    {
        $billoflanding_subsimps = DB::table('bill_of_landing_subs_imps')
            ->select(
                'bill_of_landing_subs_imps.id',
                'bill_of_landing_subs_imps.bill_of_landing_sub_id',
                'bill_of_landing_subs_imps.imp_freight_charge_in',
                'bill_of_landing_subs_imps.imp_doc_fee',
                'bill_of_landing_subs_imps.imp_thc_phc',
                'bill_of_landing_subs_imps.exp_other_recovery',
                'bill_of_landing_subs_imps.exp_other_recovery_remarks',
                'bill_of_landing_subs_imps.exp_total_in',
                'bill_of_landing_subs_imps.exp_agent_comm',
                'bill_of_landing_subs_imps.exp_phc',
                'bill_of_landing_subs_imps.imp_doc_charges',
                'bill_of_landing_subs_imps.imp_freight_charge_ex',
                'bill_of_landing_subs_imps.imp_dc_surcharge',
                'bill_of_landing_subs_imps.imp_other_expenses',
                'bill_of_landing_subs_imps.imp_other_expenses_remarks',
                'bill_of_landing_subs_imps.imp_total_ex',
                'bill_of_landing_subs_imps.imp_final_amount',
                'bill_of_landing_subs_imps.imp_remarks'
            )
            ->join('bill_of_landing_subs', 'bill_of_landing_subs_imps.bill_of_landing_sub_id', '=', 'bill_of_landing_subs.id')
            ->get();

        return $billoflanding_subsimps;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflanding_subsimps = DB::table('bill_of_landing_subs_imps')
            ->select(
                'bill_of_landing_subs_imps.id',
                'bill_of_landing_subs_imps.bill_of_landing_sub_id',
                'bill_of_landing_subs_imps.imp_freight_charge_in',
                'bill_of_landing_subs_imps.imp_doc_fee',
                'bill_of_landing_subs_imps.imp_thc_phc',
                'bill_of_landing_subs_imps.exp_other_recovery',
                'bill_of_landing_subs_imps.exp_other_recovery_remarks',
                'bill_of_landing_subs_imps.exp_total_in',
                'bill_of_landing_subs_imps.exp_agent_comm',
                'bill_of_landing_subs_imps.exp_phc',
                'bill_of_landing_subs_imps.imp_doc_charges',
                'bill_of_landing_subs_imps.imp_freight_charge_ex',
                'bill_of_landing_subs_imps.imp_dc_surcharge',
                'bill_of_landing_subs_imps.imp_other_expenses',
                'bill_of_landing_subs_imps.imp_other_expenses_remarks',
                'bill_of_landing_subs_imps.imp_total_ex',
                'bill_of_landing_subs_imps.imp_final_amount',
                'bill_of_landing_subs_imps.imp_remarks'
            )
            ->join('bill_of_landing_subs', 'bill_of_landing_subs_imps.bill_of_landing_sub_id', '=', 'bill_of_landing_subs.id')
            ->where('bill_of_landing_subs_imps.id', '=', $id)
            ->get();

        return $billoflanding_subsimps;
    }

    public function store(Request $request)
    {
        $id = $request->id;


        if ($id == 0) { // create

            $billoflandingsubsimps = new bill_of_landing_subs_imps();
        } else { // update

            $billoflandingsubsimps = bill_of_landing_subs_imps::find($id);
        }
        

        try {
            $billoflandingsubsimps->bill_of_landing_sub_id = $request->bill_of_landing_sub_id;
            $billoflandingsubsimps->imp_freight_charge_in = $request->imp_freight_charge_in;
            $billoflandingsubsimps->imp_doc_fee = $request->imp_doc_fee;
            $billoflandingsubsimps->imp_thc_phc = $request->imp_thc_phc;
            $billoflandingsubsimps->exp_other_recovery = $request->exp_other_recovery;
            $billoflandingsubsimps->exp_other_recovery_remarks = $request->exp_other_recovery_remarks;
            $billoflandingsubsimps->exp_total_in = $request->exp_total_in;
            $billoflandingsubsimps->exp_agent_comm = $request->exp_agent_comm;
            $billoflandingsubsimps->exp_phc = $request->exp_phc;
            $billoflandingsubsimps->imp_doc_charges = $request->imp_doc_charges;
            $billoflandingsubsimps->imp_freight_charge_ex = $request->imp_freight_charge_ex;
            $billoflandingsubsimps->imp_dc_surcharge = $request->imp_dc_surcharge;
            $billoflandingsubsimps->imp_other_expenses = $request->imp_other_expenses;
            $billoflandingsubsimps->imp_other_expenses_remarks = $request->imp_other_expenses_remarks;
            $billoflandingsubsimps->imp_total_ex = $request->imp_total_ex;
            $billoflandingsubsimps->imp_final_amount = $request->imp_final_amount;
            $billoflandingsubsimps->imp_remarks = $request->imp_remarks;
            $billoflandingsubsimps->imp_created_by = $request->imp_created_by;
            $billoflandingsubsimps->imp_created_date = $request->imp_created_date;
            $billoflandingsubsimps->imp_approved_by = $request->imp_approved_by;
            $billoflandingsubsimps->imp_approved_date = $request->imp_approved_date;
            $billoflandingsubsimps->save();

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
