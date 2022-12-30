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
                'receipts.date',
                'receipts.receipt_no',
                'receipts.description',
                'receipts.client_id',
                'receipts.arrival_notice_id',
                'receipts.invoice_id',
                'receipts.detention_invoice_id',
                'receipts.currency_id',
                'receipts.status',
                'receipts.deleted',
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
            ->paginate(50);

        return $receipts;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $receipts = DB::table('receipts')
            ->select(
                'receipts.id',
                'receipts.date',
                'receipts.receipt_no',
                'receipts.description',
                'receipts.client_id',
                'receipts.arrival_notice_id',
                'receipts.invoice_id',
                'receipts.detention_invoice_id',
                'receipts.currency_id',
                'receipts.status',
                'receipts.deleted',
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

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $receipts = DB::table('receipts')
                ->select(
                    'receipts.id',
                'receipts.date',
                'receipts.receipt_no',
                'receipts.description',
                'receipts.client_id',
                'receipts.arrival_notice_id',
                'receipts.invoice_id',
                'receipts.detention_invoice_id',
                'receipts.currency_id',
                'receipts.status',
                'receipts.deleted',
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
                ->where(function ($q) use ($query) {
                    $q->where('receipts.receipt_no', 'like', '%' . $query . '%')
                        ->orWhere('arrival_noticies.arrival_notice_no', 'like', '%' . $query . '%')
                        ->orWhere('invoices.invoice_no', 'like', '%' . $query . '%')
                        ->orWhere('detention_invoices.detention_no', 'like', '%' . $query . '%')
                        ->orWhere('currencies.currency_code', 'like', '%' . $query . '%')
                        ->orWhere('currencies.currency_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $receipts;
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

        // $receipts = DB::table('receipts')
        //     ->select(
        //         'receipts.id',
        //         'receipts.receipt_no',
        //         'receipts.description',
        //         'receipts.client_id',
        //         'receipts.arrival_notice_id',
        //         'receipts.invoice_id',
        //         'receipts.detention_invoice_id',
        //         'receipts.currency_id',
        //         'receipts.deleted',
        //         'arrival_noticies.arrival_notice_no',
        //         'invoices.invoice_no',
        //         'detention_invoices.detention_no',
        //         'currencies.currency_code',
        //         'currencies.currency_name'
        //     )
        //     ->join('clients', 'receipts.client_id', '=', 'clients.id')
        //     ->join('arrival_noticies', 'receipts.arrival_notice_id', '=', 'arrival_noticies.id')
        //     ->join('invoices', 'receipts.invoice_id', '=', 'invoices.id')
        //     ->join('detention_invoices', 'receipts.detention_invoice_id', '=', 'detention_invoices.id')
        //     ->join('currencies', 'receipts.currency_id', '=', 'currencies.id')

        // if (!empty($request->client_id) && !empty($request->arrival_notice_id) && !empty($request->invoice_id) && !empty($request->detention_invoices) && !empty($request->currency_id)) {
        //     // return "1";
        //     // id empty
        //      $accesspoints = $accesspoints
        //      ->where('access_models.id', '=', $request->access_model_id);
        // }
        // elseif (empty($request->access_model_id) && !empty($request->id)) {
        //     // return "2";
        //     // access_model_id empty
        //     $accesspoints = $accesspoints->where('access_points.id', '=', $request->id);
        // }
        // elseif (!empty($request->access_model_id) && !empty($request->id)) {
        //     // return "3";
        //     // no empty
        //     $accesspoints = $accesspoints
        //     ->where('access_models.id', '=', $request->access_model_id)
        //     ->where('access_points.id', '=', $request->id);
        // }
        // else
        // {
        //     // return "4";
        //     //all empty
        //     $accesspoints = $accesspoints;
        // }

        // $result = $accesspoints->orderBy('access_points.id')
        //     ->get();
        // return $result;
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

    // status change
    public function statusChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $status = 0; //inactive
        } else {
            $status = 1; //active
        }

        $receipt = receipts::find($id);
        $receipt->deleted = $status;
        $receipt->save();

        return 'Done';
    }
}
