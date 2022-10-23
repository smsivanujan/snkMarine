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
                'arrival_notices.arrival_notice_no',
                'typeofunits.type_of_unit',
                'equipments.equipment_number'
            )
            ->join('arrival_notices', 'detentioninvoicecontainerss.arrival_notice_id', '=', 'arrival_notices.id')
            ->join('typeofunits', 'detentioninvoicecontainerss.typeofunit_id', '=', 'typeofunits.id')
            ->join('equipments', 'detentioninvoicecontainerss.equipment_id', '=', 'equipments.id')
            ->get();

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
                'arrival_notices.arrival_notice_no',
                'typeofunits.type_of_unit',
                'equipments.equipment_number'
            )
            ->join('arrival_notices', 'detentioninvoicecontainerss.arrival_notice_id', '=', 'arrival_notices.id')
            ->join('typeofunits', 'detentioninvoicecontainerss.typeofunit_id', '=', 'typeofunits.id')
            ->join('equipments', 'detentioninvoicecontainerss.equipment_id', '=', 'equipments.id')
            ->where('detention_invoice_containers.id', '=', $id)
            ->get();

        return $detentioninvoicecontainers;
    }

    public function store(Request $request)
    {
        $id = $request->id;



        $detentioninvoicecontainers = new detention_invoice_containers();


        try {
            $detentioninvoicecontainers->arrival_notice_id = $request->arrival_notice_id;
            $detentioninvoicecontainers->detentioninvoicecontainers_id = $request->detentioninvoicecontainers_id;
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
}