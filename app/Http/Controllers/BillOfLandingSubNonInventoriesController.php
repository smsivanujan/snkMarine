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
                'bill_of_landing_sub_non_inventories.id',
                'bill_of_landing_sub_non_inventories.bill_of_landing_id',
                'bill_of_landing_sub_non_inventories.equipment_id',
                'bill_of_landing_sub_non_inventories.seal_no',
                'bill_of_landing_sub_non_inventories.marks',
                'bill_of_landing_sub_non_inventories.package_quantity',
                'bill_of_landing_sub_non_inventories.description',
                'bill_of_landing_sub_non_inventories.gross_weight',
                'bill_of_landing_sub_non_inventories.measurement',
                'bill_of_landing_sub_non_inventories.bill_confirmation_id',
                'bill_of_landing_sub_non_inventories.status',
                'bill_of_landing_sub_non_inventories.ignore_data',
                'bill_of_landing_sub_non_inventories.reserved_date',
                'bill_of_landing_sub_non_inventories.shipper_date',
                'bill_of_landing_sub_non_inventories.on_job_date',
                'bill_of_landing_sub_non_inventories.yard_in_date',
                'bill_of_landing_sub_non_inventories.client_id_agent',
                'bill_of_landing_sub_non_inventories.client_id_ex_agent',
                'bill_of_landing_sub_non_inventories.vendor_id_yard',
                'bill_of_landing_sub_non_inventories.free_days',
                'bill_of_landing_sub_non_inventories.free_days_standard',
                'bill_of_landing_sub_non_inventories.ata_fpd',
                'bill_of_landing_sub_non_inventories.payed_till',
                'bill_of_landing_sub_non_inventories.soa_status_exp',
                'bill_of_landing_sub_non_inventories.soa_status_imp',
                'bill_of_landing_sub_non_inventories.lift_on_off',
                'bill_of_landing_sub_non_inventories.other_expenses',
                'bill_of_landing_sub_non_inventories.other_expenses_remarks',
                'bill_of_landing_sub_non_inventories.deleted',
                'bill_of_landings.bill_of_landing_number',
                'equipments.equipment_number',
                'agent.client_code',
                'agent.client_name',
                'exagent.client_code',
                'exagent.client_name',
                'yard.vendor_code',
                'yard.vendor_name',
            )
            ->join('bill_of_landings', 'bill_of_landing_sub_non_inventories.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('equipments', 'bill_of_landing_sub_non_inventories.equipment_id', '=', 'equipments.id')
            ->join('clients as agent', 'bill_of_landing_sub_non_inventories.client_id_agent', '=', 'agent.id')
            ->join('clients as exagent', 'bill_of_landing_sub_non_inventories.client_id_ex_agent', '=', 'exagent.id')
            ->join('vendors as yard', 'bill_of_landing_sub_non_inventories.vendor_id_yard', '=', 'yard.id')
            ->paginate(50);

        return $billoflandingsubnoninventories;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $billoflandingsubnoninventories = DB::table('bill_of_landing_sub_non_inventories')
            ->select(
                'bill_of_landing_sub_non_inventories.id',
                'bill_of_landing_sub_non_inventories.bill_of_landing_id',
                'bill_of_landing_sub_non_inventories.equipment_id',
                'bill_of_landing_sub_non_inventories.seal_no',
                'bill_of_landing_sub_non_inventories.marks',
                'bill_of_landing_sub_non_inventories.package_quantity',
                'bill_of_landing_sub_non_inventories.description',
                'bill_of_landing_sub_non_inventories.gross_weight',
                'bill_of_landing_sub_non_inventories.measurement',
                'bill_of_landing_sub_non_inventories.bill_confirmation_id',
                'bill_of_landing_sub_non_inventories.status',
                'bill_of_landing_sub_non_inventories.ignore_data',
                'bill_of_landing_sub_non_inventories.reserved_date',
                'bill_of_landing_sub_non_inventories.shipper_date',
                'bill_of_landing_sub_non_inventories.on_job_date',
                'bill_of_landing_sub_non_inventories.yard_in_date',
                'bill_of_landing_sub_non_inventories.client_id_agent',
                'bill_of_landing_sub_non_inventories.client_id_ex_agent',
                'bill_of_landing_sub_non_inventories.vendor_id_yard',
                'bill_of_landing_sub_non_inventories.free_days',
                'bill_of_landing_sub_non_inventories.free_days_standard',
                'bill_of_landing_sub_non_inventories.ata_fpd',
                'bill_of_landing_sub_non_inventories.payed_till',
                'bill_of_landing_sub_non_inventories.soa_status_exp',
                'bill_of_landing_sub_non_inventories.soa_status_imp',
                'bill_of_landing_sub_non_inventories.lift_on_off',
                'bill_of_landing_sub_non_inventories.other_expenses',
                'bill_of_landing_sub_non_inventories.other_expenses_remarks',
                'bill_of_landing_sub_non_inventories.deleted',
                'bill_of_landings.bill_of_landing_number',
                'equipments.equipment_number',
                'agent.client_code',
                'agent.client_name',
                'exagent.client_code',
                'exagent.client_name',
                'yard.vendor_code',
                'yard.vendor_name',
            )
            ->join('bill_of_landings', 'bill_of_landing_sub_non_inventories.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('equipments', 'bill_of_landing_sub_non_inventories.equipment_id', '=', 'equipments.id')
            ->join('clients as agent', 'bill_of_landing_sub_non_inventories.client_id_agent', '=', 'agent.id')
            ->join('clients as exagent', 'bill_of_landing_sub_non_inventories.client_id_ex_agent', '=', 'exagent.id')
            ->join('vendors as yard', 'bill_of_landing_sub_non_inventories.vendor_id_yard', '=', 'yard.id')
            ->where('bill_of_landing_sub_non_inventories.id', '=', $id)
            ->get();

        return $billoflandingsubnoninventories;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $billoflandingsubnoninventories = DB::table('bill_of_landing_sub_non_inventories')
            ->select(
                'bill_of_landing_sub_non_inventories.id',
                'bill_of_landing_sub_non_inventories.bill_of_landing_id',
                'bill_of_landing_sub_non_inventories.equipment_id',
                'bill_of_landing_sub_non_inventories.seal_no',
                'bill_of_landing_sub_non_inventories.marks',
                'bill_of_landing_sub_non_inventories.package_quantity',
                'bill_of_landing_sub_non_inventories.description',
                'bill_of_landing_sub_non_inventories.gross_weight',
                'bill_of_landing_sub_non_inventories.measurement',
                'bill_of_landing_sub_non_inventories.bill_confirmation_id',
                'bill_of_landing_sub_non_inventories.status',
                'bill_of_landing_sub_non_inventories.ignore_data',
                'bill_of_landing_sub_non_inventories.reserved_date',
                'bill_of_landing_sub_non_inventories.shipper_date',
                'bill_of_landing_sub_non_inventories.on_job_date',
                'bill_of_landing_sub_non_inventories.yard_in_date',
                'bill_of_landing_sub_non_inventories.client_id_agent',
                'bill_of_landing_sub_non_inventories.client_id_ex_agent',
                'bill_of_landing_sub_non_inventories.vendor_id_yard',
                'bill_of_landing_sub_non_inventories.free_days',
                'bill_of_landing_sub_non_inventories.free_days_standard',
                'bill_of_landing_sub_non_inventories.ata_fpd',
                'bill_of_landing_sub_non_inventories.payed_till',
                'bill_of_landing_sub_non_inventories.soa_status_exp',
                'bill_of_landing_sub_non_inventories.soa_status_imp',
                'bill_of_landing_sub_non_inventories.lift_on_off',
                'bill_of_landing_sub_non_inventories.other_expenses',
                'bill_of_landing_sub_non_inventories.other_expenses_remarks',
                'bill_of_landing_sub_non_inventories.deleted',
                'bill_of_landings.bill_of_landing_number',
                'equipments.equipment_number',
                'agent.client_code',
                'agent.client_name',
                'exagent.client_code',
                'exagent.client_name',
                'yard.vendor_code',
                'yard.vendor_name',
            )
            ->join('bill_of_landings', 'bill_of_landing_sub_non_inventories.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('equipments', 'bill_of_landing_sub_non_inventories.equipment_id', '=', 'equipments.id')
            ->join('clients as agent', 'bill_of_landing_sub_non_inventories.client_id_agent', '=', 'agent.id')
            ->join('clients as exagent', 'bill_of_landing_sub_non_inventories.client_id_ex_agent', '=', 'exagent.id')
            ->join('vendors as yard', 'bill_of_landing_sub_non_inventories.vendor_id_yard', '=', 'yard.id')
                ->where(function ($q) use ($query) {
                    $q->where('bill_of_landings.bill_of_landing_number', 'like', '%' . $query . '%')
                        ->orWhere('equipments.equipment_number', 'like', '%' . $query . '%')
                        ->orWhere('agent.client_code', 'like', '%' . $query . '%')
                        ->orWhere('agent.client_name', 'like', '%' . $query . '%')
                        ->orWhere('yard.vendor_code', 'like', '%' . $query . '%')
                        ->orWhere('yard.vendor_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $billoflandingsubnoninventories;
    }


    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $billoflandingsubnoninventory = new bill_of_landing_sub_non_inventories();
        } else { // update

            $billoflandingsubnoninventory = bill_of_landing_sub_non_inventories::find($id);
        }


        try {
            $billoflandingsubnoninventory->bill_of_landing_id = $request->bill_of_landing_id;
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

        $billoflandingsubnoninventory = bill_of_landing_sub_non_inventories::find($id);
        $billoflandingsubnoninventory->deleted = $status;
        $billoflandingsubnoninventory->save();

        return 'Done';
    }
}
