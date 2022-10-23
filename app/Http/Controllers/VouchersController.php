<?php

namespace App\Http\Controllers;

use App\Models\vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VouchersController extends Controller
{
    public function index()
    {
        $vouchers = DB::table('vouchers')
            ->select(
                'vouchers.id',
                'vouchers.date',
                'vouchers.voucher_no',
                'vouchers.description',
                'vouchers.booking_confirmation_id',
                'vouchers.bill_of_landing_id',
                'vouchers.vendor_id',
                'vouchers.currency_id',
                'vouchers.status',
                'vouchers.deleted',
                'booking_confirmations.booking_confirmation_number',
                'bill_of_landings.bill_of_landing_number',
                'vendors.vendor_code',
                'vendors.vendor_name'
            )
            ->join('booking_confirmations', 'vouchers.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('bill_of_landings', 'vouchers.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('vendors', 'vouchers.vendor_id', '=', 'vendors.id')
            ->join('currencies', 'vouchers.currency_id', '=', 'currencies.id')
            ->get();

        return $vouchers;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $vouchers = DB::table('vouchers')
            ->select(
                'vouchers.id',
                'vouchers.date',
                'vouchers.voucher_no',
                'vouchers.description',
                'vouchers.booking_confirmation_id',
                'vouchers.bill_of_landing_id',
                'vouchers.vendor_id',
                'vouchers.currency_id',
                'vouchers.status',
                'vouchers.deleted',
                'booking_confirmations.booking_confirmation_number',
                'bill_of_landings.bill_of_landing_number',
                'vendors.vendor_code',
                'vendors.vendor_name'
            )
            ->join('booking_confirmations', 'vouchers.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('bill_of_landings', 'vouchers.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('vendors', 'vouchers.vendor_id', '=', 'vendors.id')
            ->join('currencies', 'vouchers.currency_id', '=', 'currencies.id')
            ->where('vouchers.id', '=', $id)
            ->get();

        return $vouchers;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'voucher_no' => 'required|unique:vouchers,voucher_no',
            ]);


            $voucher = new vouchers();
        } else { // update

            $this->validate($request, [
                'voucher_no' => 'required|unique:vouchers,voucher_no,' . $id
            ]);

            $voucher = vouchers::find($id);
        }

        try {
            $voucher->date = $request->date;
            $voucher->voucher_no = $request->voucher_no;
            $voucher->description = $request->description;
            $voucher->booking_confirmation_id = $request->booking_confirmation_id;
            $voucher->bill_of_landing_id = $request->bill_of_landing_id;
            $voucher->vendor_id = $request->vendor_id;
            $voucher->currency_id = $request->currency_id;
            $voucher->status = $request->status;
            $voucher->deleted = $request->deleted;
            $voucher->save();

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
