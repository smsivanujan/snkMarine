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
                'vendors.vendor_name',
                'currencies.currency_code',
                'currencies.currency_name'
            )
            ->join('booking_confirmations', 'vouchers.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('bill_of_landings', 'vouchers.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('vendors', 'vouchers.vendor_id', '=', 'vendors.id')
            ->join('currencies', 'vouchers.currency_id', '=', 'currencies.id')
            ->paginate(50);

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
                'vendors.vendor_name',
                'currencies.currency_code',
                'currencies.currency_name'
            )
            ->join('booking_confirmations', 'vouchers.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('bill_of_landings', 'vouchers.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('vendors', 'vouchers.vendor_id', '=', 'vendors.id')
            ->join('currencies', 'vouchers.currency_id', '=', 'currencies.id')
            ->where('vouchers.id', '=', $id)
            ->get();

        return $vouchers;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

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
                    'vendors.vendor_name',
                    'currencies.currency_code',
                    'currencies.currency_name'
                )
                ->join('booking_confirmations', 'vouchers.booking_confirmation_id', '=', 'booking_confirmations.id')
                ->join('bill_of_landings', 'vouchers.bill_of_landing_id', '=', 'bill_of_landings.id')
                ->join('vendors', 'vouchers.vendor_id', '=', 'vendors.id')
                ->join('currencies', 'vouchers.currency_id', '=', 'currencies.id')
                ->where(function ($q) use ($query) {
                    $q->where('vouchers.date', 'like', '%' . $query . '%')
                        ->orWhere('vouchers.voucher_no', 'like', '%' . $query . '%')
                        ->orWhere('booking_confirmations.booking_confirmation_number', 'like', '%' . $query . '%')
                        ->orWhere('bill_of_landings.bill_of_landing_number', 'like', '%' . $query . '%')
                        ->orWhere('vendors.vendor_code', 'like', '%' . $query . '%')
                        ->orWhere('vendors.vendor_name', 'like', '%' . $query . '%')
                        ->orWhere('currencies.currency_code', 'like', '%' . $query . '%')
                        ->orWhere('currencies.currency_name', 'like', '%' . $query . '%');
                })
                ->get();

            return $vouchers;
        }
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

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
                'vendors.vendor_name',
                'currencies.currency_code',
                'currencies.currency_name'
            )
            ->join('booking_confirmations', 'vouchers.booking_confirmation_id', '=', 'booking_confirmations.id')
            ->join('bill_of_landings', 'vouchers.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('vendors', 'vouchers.vendor_id', '=', 'vendors.id')
            ->join('currencies', 'vouchers.currency_id', '=', 'currencies.id');

        if (!empty($request->booking_confirmation_id) && !empty($request->bill_of_landing_id) && !empty($request->vendor_id) && !empty($request->currency_id)) {
            // return "1";
            // id empty
            $vouchers = $vouchers
                ->where('access_models.id', '=', $request->access_model_id);
        } elseif (!empty($request->booking_confirmation_id) && empty($request->bill_of_landing_id) && !empty($request->vendor_id) && !empty($request->currency_id)) {
            // return "2";
            // access_model_id empty
            $vouchers = $vouchers->where('access_points.id', '=', $request->id);
        } elseif (!empty($request->booking_confirmation_id) && !empty($request->bill_of_landing_id) && empty($request->vendor_id) && !empty($request->currency_id)) {
            // return "3";
            // no empty
            $vouchers = $vouchers
                ->where('access_models.id', '=', $request->access_model_id)
                ->where('access_points.id', '=', $request->id);
        } elseif (!empty($request->booking_confirmation_id) && !empty($request->bill_of_landing_id) && !empty($request->vendor_id) && empty($request->currency_id)) {
            // return "3";
            // no empty
            $vouchers = $vouchers
                ->where('access_models.id', '=', $request->access_model_id)
                ->where('access_points.id', '=', $request->id);
        } elseif (!empty($request->booking_confirmation_id) && !empty($request->bill_of_landing_id) && !empty($request->vendor_id) && !empty($request->currency_id)) {
            // return "3";
            // no empty
            $vouchers = $vouchers
                ->where('access_models.id', '=', $request->access_model_id)
                ->where('access_points.id', '=', $request->id);
        } elseif (!empty($request->booking_confirmation_id) && !empty($request->bill_of_landing_id) && !empty($request->vendor_id) && !empty($request->currency_id)) {
            // return "3";
            // no empty
            $vouchers = $vouchers
                ->where('access_models.id', '=', $request->access_model_id)
                ->where('access_points.id', '=', $request->id);
        } elseif (!empty($request->booking_confirmation_id) && !empty($request->bill_of_landing_id) && !empty($request->vendor_id) && !empty($request->currency_id)) {
            // return "3";
            // no empty
            $vouchers = $vouchers
                ->where('access_models.id', '=', $request->access_model_id)
                ->where('access_points.id', '=', $request->id);
        } else {
            // return "4";
            //all empty
            $vouchers = $vouchers;
        }

        $result = $vouchers->orderBy('access_points.id')
            ->get();
        return $result;
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

        $voucher = vouchers::find($id);
        $voucher->deleted = $status;
        $voucher->save();

        return 'Done';
    }
}
