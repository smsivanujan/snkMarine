<?php

namespace App\Http\Controllers;

use App\Models\detention_invoice_containers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DetentionInvoiceContainersController extends Controller
{
    public function index()
    {
        $detentioninvoicecontainers = DB::table('detention_invoice_containers')
            ->select(
                'detention_invoice_containers.id',
                'detention_invoice_containers.arrival_notice_id',
                'detention_invoice_containers.equipment_id',
                'detention_invoice_containers.seal_no',
                'detention_invoice_containers.marks',
                'detention_invoice_containers.type_of_unit_id',
                'detention_invoice_containers.payed',
                'detention_invoice_containers.other_recovery',
                'detention_invoice_containers.remarks',
                'detention_invoice_containers.status',
                'detention_invoice_containers.deleted',
                'arrival_noticies.arrival_notice_no',
                'type_of_units.type_of_unit',
                'equipments.equipment_number'
            )
            ->join('arrival_noticies', 'detention_invoice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
            ->join('type_of_units', 'detention_invoice_containers.type_of_unit_id', '=', 'type_of_units.id')
            ->join('equipments', 'detention_invoice_containers.equipment_id', '=', 'equipments.id')
            ->paginate(50);

        return $detentioninvoicecontainers;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $detentioninvoicecontainers = DB::table('detention_invoice_containers')
            ->select(
                'detention_invoice_containers.id',
                'detention_invoice_containers.arrival_notice_id',
                'detention_invoice_containers.equipment_id',
                'detention_invoice_containers.seal_no',
                'detention_invoice_containers.marks',
                'detention_invoice_containers.type_of_unit_id',
                'detention_invoice_containers.payed',
                'detention_invoice_containers.other_recovery',
                'detention_invoice_containers.remarks',
                'detention_invoice_containers.status',
                'detention_invoice_containers.deleted',
                'arrival_noticies.arrival_notice_no',
                'type_of_units.type_of_unit',
                'equipments.equipment_number'
            )
            ->join('arrival_noticies', 'detention_invoice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
            ->join('type_of_units', 'detention_invoice_containers.type_of_unit_id', '=', 'type_of_units.id')
            ->join('equipments', 'detention_invoice_containers.equipment_id', '=', 'equipments.id')
            ->where('detention_invoice_containers.id', '=', $id)
            ->get();

        return $detentioninvoicecontainers;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $detentioninvoicecontainers = DB::table('detention_invoice_containers')
            ->select(
                'detention_invoice_containers.id',
                'detention_invoice_containers.arrival_notice_id',
                'detention_invoice_containers.equipment_id',
                'detention_invoice_containers.seal_no',
                'detention_invoice_containers.marks',
                'detention_invoice_containers.type_of_unit_id',
                'detention_invoice_containers.payed',
                'detention_invoice_containers.other_recovery',
                'detention_invoice_containers.remarks',
                'detention_invoice_containers.status',
                'detention_invoice_containers.deleted',
                'arrival_noticies.arrival_notice_no',
                'type_of_units.type_of_unit',
                'equipments.equipment_number'
            )
            ->join('arrival_noticies', 'detention_invoice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
            ->join('type_of_units', 'detention_invoice_containers.type_of_unit_id', '=', 'type_of_units.id')
            ->join('equipments', 'detention_invoice_containers.equipment_id', '=', 'equipments.id')
                ->where(function ($q) use ($query) {
                    $q->where('arrival_noticies.arrival_notice_no', 'like', '%' . $query . '%')
                    ->orWhere('type_of_units.type_of_unit', 'like', '%' . $query . '%')
                    ->orWhere('equipments.equipment_number', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $detentioninvoicecontainers;
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

        $detentioninvoicecontainers = DB::table('detention_invoice_containers')
            ->select(
                'detention_invoice_containers.id',
                'detention_invoice_containers.arrival_notice_id',
                'detention_invoice_containers.equipment_id',
                'detention_invoice_containers.seal_no',
                'detention_invoice_containers.marks',
                'detention_invoice_containers.type_of_unit_id',
                'detention_invoice_containers.payed',
                'detention_invoice_containers.other_recovery',
                'detention_invoice_containers.remarks',
                'detention_invoice_containers.status',
                'detention_invoice_containers.deleted',
                'arrival_noticies.arrival_notice_no',
                'type_of_units.type_of_unit',
                'equipments.equipment_number'
            )
            ->join('arrival_noticies', 'detention_invoice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
            ->join('equipments', 'detention_invoice_containers.equipment_id', '=', 'equipments.id')
            ->join('type_of_units', 'detention_invoice_containers.type_of_unit_id', '=', 'type_of_units.id');
            

            if (!empty($request->arrival_notice_id) && !empty($request->equipment_id) && !empty($request->type_of_unit_id)) {

                $detentioninvoicecontainers = $detentioninvoicecontainers
                    ->where('detention_invoice_containers.arrival_notice_id', '=', $request->arrival_notice_id)
                    ->where('detention_invoice_containers.equipment_id', '=', $request->equipment_id)
                    ->where('detention_invoice_containers.type_of_unit_id', '=', $request->type_of_unit_id);
            } elseif (!empty($request->arrival_notice_id) && empty($request->equipment_id) && !empty($request->type_of_unit_id)) {
    
                $detentioninvoicecontainers = $detentioninvoicecontainers
                    ->where('detention_invoice_containers.arrival_notice_id', '=', $request->arrival_notice_id)
                    ->where('detention_invoice_containers.type_of_unit_id', '=', $request->type_of_unit_id);
            } elseif (!empty($request->arrival_notice_id) && !empty($request->equipment_id) && empty($request->type_of_unit_id)) {
    
                $detentioninvoicecontainers = $detentioninvoicecontainers
                ->where('detention_invoice_containers.arrival_notice_id', '=', $request->arrival_notice_id)
                ->where('detention_invoice_containers.equipment_id', '=', $request->equipment_id);
            }
            elseif (!empty($request->arrival_notice_id) && empty($request->equipment_id) && empty($request->type_of_unit_id)) {
    
                $detentioninvoicecontainers = $detentioninvoicecontainers
                ->where('detention_invoice_containers.arrival_notice_id', '=', $request->arrival_notice_id);
            } elseif (empty($request->arrival_notice_id) && !empty($request->equipment_id) && !empty($request->type_of_unit_id)) {
    
                $detentioninvoicecontainers = $detentioninvoicecontainers
                ->where('detention_invoice_containers.equipment_id', '=', $request->equipment_id)
                ->where('detention_invoice_containers.type_of_unit_id', '=', $request->type_of_unit_id);
            } elseif (empty($request->arrival_notice_id) && !empty($request->equipment_id) && empty($request->type_of_unit_id)) {
        
                $detentioninvoicecontainers = $detentioninvoicecontainers
                ->where('detention_invoice_containers.equipment_id', '=', $request->equipment_id);
            } elseif (empty($request->arrival_notice_id) && empty($request->equipment_id) && !empty($request->type_of_unit_id)) {
    
                $detentioninvoicecontainers = $detentioninvoicecontainers
                ->where('detention_invoice_containers.type_of_unit_id', '=', $request->type_of_unit_id);
            } else {
    
                $detentioninvoicecontainers = $detentioninvoicecontainers;
            }

        $result = $detentioninvoicecontainers->orderBy('detention_invoice_containers.id')
            ->get();
        return $result;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $detentioninvoicecontainers = new detention_invoice_containers();
        } else { // update

            $detentioninvoicecontainers = detention_invoice_containers::find($id);
        }


        try {
            $detentioninvoicecontainers->arrival_notice_id = $request->arrival_notice_id;
            $detentioninvoicecontainers->equipment_id = $request->equipment_id;
            $detentioninvoicecontainers->seal_no = $request->seal_no;
            $detentioninvoicecontainers->marks = $request->marks;
            $detentioninvoicecontainers->type_of_unit_id = $request->type_of_unit_id;
            $detentioninvoicecontainers->payed = $request->payed;
            $detentioninvoicecontainers->other_recovery = $request->other_recovery;
            $detentioninvoicecontainers->remarks = $request->remarks;
            $detentioninvoicecontainers->status = $request->status;
            $detentioninvoicecontainers->deleted = $request->deleted;
            $detentioninvoicecontainers->save();

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

        $detentioninvoicecontainers = detention_invoice_containers::find($id);
        $detentioninvoicecontainers->deleted = $status;
        $detentioninvoicecontainers->save();

        return 'Done';
    }
}
