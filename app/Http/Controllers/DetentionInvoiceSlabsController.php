<?php

namespace App\Http\Controllers;

use App\Models\detention_invoice_slabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DetentionInvoiceSlabsController extends Controller
{
    public function index()
    {
        $detentioninvoiceslabs = DB::table('detention_invoice_slabs')
            ->select(
                'detention_invoice_slabs.id',
                'detention_invoice_slabs.detention_invoice_id',
                'detention_invoice_slabs.slab_no',
                'detention_invoice_slabs.amount',
                'detention_invoices.detention_no'
            )
            ->join('detention_invoices', 'equipments.detention_invoice_id', '=', 'detention_invoices.id')
            ->get();

        return $detentioninvoiceslabs;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $detentioninvoiceslabs = DB::table('detention_invoice_slabs')
            ->select(
                'detention_invoice_slabs.id',
                'detention_invoice_slabs.detention_invoice_id',
                'detention_invoice_slabs.slab_no',
                'detention_invoice_slabs.amount',
                'detention_invoices.detention_no'
            )
            ->join('detention_invoices', 'equipments.detention_invoice_id', '=', 'detention_invoices.id')
            ->where('equipments.id', '=', $id)
            ->get();

        return $detentioninvoiceslabs;
    }

    public function store(Request $request)
    {
        $id = $request->id;

 
            $detentioninvoiceslabs = new detention_invoice_slabs();


        try {
            $detentioninvoiceslabs->detention_invoice_id = $request->detention_invoice_id;
            $detentioninvoiceslabs->slab_no = $request->slab_no;
            $detentioninvoiceslabs->amount = $request->amount;
            $detentioninvoiceslabs->save();

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
