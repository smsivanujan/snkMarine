<?php

namespace App\Http\Controllers;

use App\Models\bill_of_landing_sub_switches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillOfLandingSubSwitchesController extends Controller
{
    public function index()
    {
        $billoflandingsubswitches = DB::table('bill_of_landing_sub_switches')
            ->select(
                'bill_of_landing_sub_switches.id',
                'bill_of_landing_sub_switches.bill_of_landing_id',
                'bill_of_landing_sub_switches.equipment_id',
                'bill_of_landing_sub_switches.seal_no',
                'bill_of_landing_sub_switches.marks',
                'bill_of_landing_sub_switches.package_quantity',
                'bill_of_landing_sub_switches.description',
                'bill_of_landing_sub_switches.gross_weight',
                'bill_of_landing_sub_switches.measurement',
                'bill_of_landing_sub_switches.bill_confirmation_id',
                'bill_of_landing_sub_switches.status',
                'bill_of_landing_sub_switches.ignore_data',
                'bill_of_landing_sub_switches.reserved_date',
                'bill_of_landing_sub_switches.shipper_date',
                'bill_of_landing_sub_switches.on_job_date',
                'bill_of_landing_sub_switches.yard_in_date',
                'bill_of_landing_sub_switches.client_id_agent',
                'bill_of_landing_sub_switches.client_id_ex_agent',
                'bill_of_landing_sub_switches.vendor_id_yard',
                'bill_of_landing_sub_switches.free_days',
                'bill_of_landing_sub_switches.free_days_standard',
                'bill_of_landing_sub_switches.ata_fpd',
                'bill_of_landing_sub_switches.payed_till',
                'bill_of_landing_sub_switches.soa_status_exp',
                'bill_of_landing_sub_switches.soa_status_imp',
                'bill_of_landing_sub_switches.lift_on_off',
                'bill_of_landing_sub_switches.other_expenses',
                'bill_of_landing_sub_switches.other_expenses_remarks',
                'bill_of_landing_sub_switches.deleted',
                'bill_of_landings.bill_of_landing_number',
                'equipments.equipment_number',
                'agent.client_code',
                'agent.client_name',
                'ex_agent.client_code',
                'ex_agent.client_name',
                'yard.vendor_code',
                'yard.vendor_name'
            )
            ->join('bill_of_landings', 'bill_of_landing_sub_switches.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('equipments', 'bill_of_landing_sub_switches.equipment_id', '=', 'equipments.id')
            ->join('clients as agent', 'bill_of_landing_sub_switches.client_id_agent', '=', 'agent.id')
            ->join('clients as ex_agent', 'bill_of_landing_sub_switches.client_id_ex_agent', '=', 'ex_agent.id')
            ->join('vendors as yard', 'bill_of_landing_sub_switches.vendor_id_yard', '=', 'yard.id')
            ->paginate(50);

        return $billoflandingsubswitches;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubswitches = DB::table('bill_of_landing_sub_switches')
            ->select(
                'bill_of_landing_sub_switches.id',
                'bill_of_landing_sub_switches.bill_of_landing_id',
                'bill_of_landing_sub_switches.equipment_id',
                'bill_of_landing_sub_switches.seal_no',
                'bill_of_landing_sub_switches.marks',
                'bill_of_landing_sub_switches.package_quantity',
                'bill_of_landing_sub_switches.description',
                'bill_of_landing_sub_switches.gross_weight',
                'bill_of_landing_sub_switches.measurement',
                'bill_of_landing_sub_switches.bill_confirmation_id',
                'bill_of_landing_sub_switches.status',
                'bill_of_landing_sub_switches.ignore_data',
                'bill_of_landing_sub_switches.reserved_date',
                'bill_of_landing_sub_switches.shipper_date',
                'bill_of_landing_sub_switches.on_job_date',
                'bill_of_landing_sub_switches.yard_in_date',
                'bill_of_landing_sub_switches.client_id_agent',
                'bill_of_landing_sub_switches.client_id_ex_agent',
                'bill_of_landing_sub_switches.vendor_id_yard',
                'bill_of_landing_sub_switches.free_days',
                'bill_of_landing_sub_switches.free_days_standard',
                'bill_of_landing_sub_switches.ata_fpd',
                'bill_of_landing_sub_switches.payed_till',
                'bill_of_landing_sub_switches.soa_status_exp',
                'bill_of_landing_sub_switches.soa_status_imp',
                'bill_of_landing_sub_switches.lift_on_off',
                'bill_of_landing_sub_switches.other_expenses',
                'bill_of_landing_sub_switches.other_expenses_remarks',
                'bill_of_landing_sub_switches.deleted',
                'bill_of_landings.bill_of_landing_number',
                'equipments.equipment_number',
                'agent.client_code',
                'agent.client_name',
                'ex_agent.client_code',
                'ex_agent.client_name',
                'yard.vendor_code',
                'yard.vendor_name'
            )
            ->join('bill_of_landings', 'bill_of_landing_sub_switches.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('equipments', 'bill_of_landing_sub_switches.equipment_id', '=', 'equipments.id')
            ->join('clients as agent', 'bill_of_landing_sub_switches.client_id_agent', '=', 'agent.id')
            ->join('clients as ex_agent', 'bill_of_landing_sub_switches.client_id_ex_agent', '=', 'ex_agent.id')
            ->join('vendors as yard', 'bill_of_landing_sub_switches.vendor_id_yard', '=', 'yard.id')
            ->where('bill_of_landing_sub_switches.id', '=', $id)
            ->get();

        return $billoflandingsubswitches;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $bl_sub_switch = new bill_of_landing_sub_switches();
        } else { // update

            $bl_sub_switch = bill_of_landing_sub_switches::find($id);
        }



        try {
            $bl_sub_switch->bill_of_landing_id = $request->bill_of_landing_id;
            $bl_sub_switch->equipment_id = $request->equipment_id;
            $bl_sub_switch->seal_no = $request->seal_no;
            $bl_sub_switch->marks = $request->marks;
            $bl_sub_switch->package_quantity = $request->package_quantity;
            $bl_sub_switch->description = $request->description;
            $bl_sub_switch->gross_weight = $request->gross_weight;
            $bl_sub_switch->measurement = $request->measurement;
            $bl_sub_switch->bill_confirmation_id = $request->bill_confirmation_id;
            $bl_sub_switch->status = $request->status;
            $bl_sub_switch->ignore_data = $request->ignore_data;
            $bl_sub_switch->reserved_date = $request->reserved_date;
            $bl_sub_switch->shipper_date = $request->shipper_date;
            $bl_sub_switch->on_job_date = $request->on_job_date;
            $bl_sub_switch->yard_in_date = $request->yard_in_date;
            $bl_sub_switch->client_id_agent = $request->client_id_agent;
            $bl_sub_switch->client_id_ex_agent = $request->client_id_ex_agent;
            $bl_sub_switch->vendor_id_yard = $request->vendor_id_yard;
            $bl_sub_switch->free_days = $request->free_days;
            $bl_sub_switch->free_days_standard = $request->free_days_standard;
            $bl_sub_switch->ata_fpd = $request->ata_fpd;
            $bl_sub_switch->payed_till = $request->payed_till;
            $bl_sub_switch->soa_status_exp = $request->soa_status_exp;
            $bl_sub_switch->soa_status_imp = $request->soa_status_imp;
            $bl_sub_switch->lift_on_off = $request->lift_on_off;
            $bl_sub_switch->other_expenses = $request->other_expenses;
            $bl_sub_switch->other_expenses_remarks = $request->other_expenses_remarks;
            $bl_sub_switch->deleted = $request->deleted;
            $bl_sub_switch->save();

            $data = [
                'is_create' => true,
                'error' => []
            ];

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }

    // status change
    public function statusChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $status = 0;//inactive
        } else {
            $status = 1;//active
        }

        $bl_sub_switch = bill_of_landing_sub_switches::find($id);
        $bl_sub_switch->deleted = $status;
        $bl_sub_switch->save();

        return 'Done';
    }
}
