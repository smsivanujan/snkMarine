<?php

namespace App\Http\Controllers;

use App\Models\receipt_payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReceiptPaymentsController extends Controller
{
    public function index()
    {
        $receiptpayments = DB::table('receipt_payments')
            ->select(
                'receipt_payments.id',
                'receipt_payments.receipt_id',
                'receipt_payments.pay_type',
                'receipt_payments.cheque_no',
                'receipt_payments.cheque_date',
                'receipt_payments.current_bal',
                'receipt_payments.paying_amount',
                'receipt_payments.paying_local',
                'receipt_payments.status',
                'receipt_payments.deleted',
                'receipts.receipt_no'
            )
            ->join('receipts', 'receipt_payments.receipt_id', '=', 'receipts.id')
            ->get();

        return $receiptpayments;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $receiptpayments = DB::table('receipt_payments')
        ->select(
            'receipt_payments.id',
            'receipt_payments.receipt_id',
            'receipt_payments.pay_type',
            'receipt_payments.cheque_no',
            'receipt_payments.cheque_date',
            'receipt_payments.current_bal',
            'receipt_payments.paying_amount',
            'receipt_payments.paying_local',
            'receipt_payments.status',
            'receipt_payments.deleted',
            'receipts.receipt_no'
        )
        ->join('receipts', 'receipt_payments.receipt_id', '=', 'receipts.id')
            ->where('receipts.id', '=', $id)
            ->get();

        return $receiptpayments;
    }

    public function store(Request $request)
    {
        $id = $request->id;


        if ($id == 0) { // create

            $this->validate($request, [
                'cheque_no' => 'required|unique:receipt_payments,cheque_no',
            ]);


            $receiptpayment = new receipt_payments();
        } else { // update

            $this->validate($request, [
                'cheque_no' => 'required|unique:receipt_payments,cheque_no,' . $id
            ]);

            $receiptpayment = receipt_payments::find($id);
        }

        try {
            $receiptpayment->receipt_id = $request->receipt_id;
            $receiptpayment->pay_type = $request->pay_type;
            $receiptpayment->cheque_no = $request->cheque_no;
            $receiptpayment->cheque_date = $request->cheque_date;
            $receiptpayment->current_bal = $request->current_bal;
            $receiptpayment->paying_amount = $request->paying_amount;
            $receiptpayment->paying_local = $request->paying_local;
            $receiptpayment->status = $request->status;
            $receiptpayment->deleted = $request->deleted;
            $receiptpayment->save();

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
