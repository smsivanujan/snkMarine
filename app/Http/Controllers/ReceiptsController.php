<?php

namespace App\Http\Controllers;

use App\Models\receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReceiptsController extends Controller
{
    public function index()
    {
        $receipts = DB::table('receipts')
            ->select(
                'receipts.id',
                'receipts.receipt_no',
                'receipts.description',
                'receipts.client_id',
                'receipts.arrival_notice_id',
                'receipts.invoice_id',
                'receipts.detention_invoice_id',
                'receipts.currency_id',
                'receipts.deleted',
                'receipts.owner_name',
                'arrival_noticies.arrival_notice_no',
                'invoices.invoice_no',
                'detention_invoices.detention_no',
                'currencies.currency_code',
                'currencies.currency_name'
            )
            ->join('clients', 'receipts.client_id', '=', 'clients.id')
            ->join('arrival_noticies', 'receipts.arrival_notice_id', '=', 'arrival_noticies.id')
            ->join('invoices', 'receipts.invoice_id', '=', 'invoices.id')
            ->join('detention_invoices', 'receipts.detention_invoice_id', '=', 'detention_invoices.id')
            ->join('currencies', 'receipts.currency_id', '=', 'currencies.id')
            ->get();

        return $receipts;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $receipts = DB::table('receipts')
        ->select(
            'receipts.id',
            'receipts.receipt_no',
            'receipts.description',
            'receipts.client_id',
            'receipts.arrival_notice_id',
            'receipts.invoice_id',
            'receipts.detention_invoice_id',
            'receipts.currency_id',
            'receipts.deleted',
            'receipts.owner_name',
            'arrival_noticies.arrival_notice_no',
            'invoices.invoice_no',
            'detention_invoices.detention_no',
            'currencies.currency_code',
            'currencies.currency_name'
        )
        ->join('clients', 'receipts.client_id', '=', 'clients.id')
        ->join('arrival_noticies', 'receipts.arrival_notice_id', '=', 'arrival_noticies.id')
        ->join('invoices', 'receipts.invoice_id', '=', 'invoices.id')
        ->join('detention_invoices', 'receipts.detention_invoice_id', '=', 'detention_invoices.id')
        ->join('currencies', 'receipts.currency_id', '=', 'currencies.id')
            ->where('receipts.id', '=', $id)
            ->get();

        return $receipts;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'receipt_no' => 'required|unique:receipts,receipt_no',
            ]);


            $receipt = new receipts();
        } else { // update

            $this->validate($request, [
                'receipt_no' => 'required|unique:receipts,receipt_no,' . $id
            ]);

            $receipt = receipts::find($id);
        }

        try {
            $receipt->date = $request->date;
            $receipt->receipt_no = $request->receipt_no;
            $receipt->description = $request->description;
            $receipt->client_id = $request->client_id;
            $receipt->arrival_notice_id = $request->arrival_notice_id;
            $receipt->invoice_id = $request->invoice_id;
            $receipt->detention_invoice_id = $request->detention_invoice_id;
            $receipt->currency_id = $request->currency_id;
            $receipt->status = $request->status;
            $receipt->deleted = $request->deleted;
            $receipt->save();

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
