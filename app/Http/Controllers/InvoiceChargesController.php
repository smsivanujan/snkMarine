<?php

namespace App\Http\Controllers;

use App\Models\invoice_charges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceChargesController extends Controller
{
    public function index()
    {
        $invoicecharges = DB::table('invoice_charges')
            ->select(
                'invoice_charges.id',
                'invoice_charges.invoice_id',
                'invoice_charges.description',
                'invoice_charges.unit',
                'invoice_charges.unit_cost',
                'invoice_charges.unit_charge',
                'invoice_charges.amount',
                'invoice_charges.currency_id',
                'invoice_charges.currency_id_mycurrency',
                'invoice_charges.exchange_rate',
                'invoice_charges.amount_in',
                'invoice_charges.tax_description',
                'invoice_charges.tax',
                'invoice_charges.tax_amount',
                'invoice_charges.amount_final',
                'invoice_charges.total_cost',
                'invoice_charges.total_cost_in',
                'invoice_charges.profit',
                'invoice_charges.profit_in',
                'currencies.currency_code',
                'currencies.currency_name',
                'mycurrency.currency_code',
                'mycurrency.currency_name',
            )
            ->join('invoices', 'invoice_charges.invoice_id', '=', 'invoices.id')
            ->join('currencies', 'invoice_charges.currency_id', '=', 'currencies.id')
            ->join('currencies as mycurrency', 'invoice_charges.currency_id_mycurrency', '=', 'mycurrency.id')
            ->get();

        return $invoicecharges;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $invoicecharges = DB::table('invoice_charges')
            ->select(
                'invoice_charges.id',
                'invoice_charges.invoice_id',
                'invoice_charges.description',
                'invoice_charges.unit',
                'invoice_charges.unit_cost',
                'invoice_charges.unit_charge',
                'invoice_charges.amount',
                'invoice_charges.currency_id',
                'invoice_charges.currency_id_mycurrency',
                'invoice_charges.exchange_rate',
                'invoice_charges.amount_in',
                'invoice_charges.tax_description',
                'invoice_charges.tax',
                'invoice_charges.tax_amount',
                'invoice_charges.amount_final',
                'invoice_charges.total_cost',
                'invoice_charges.total_cost_in',
                'invoice_charges.profit',
                'invoice_charges.profit_in',
                'currencies.currency_code',
                'currencies.currency_name',
                'mycurrency.currency_code',
                'mycurrency.currency_name',
            )
            ->join('invoices', 'invoice_charges.invoice_id', '=', 'invoices.id')
            ->join('currencies', 'invoice_charges.currency_id', '=', 'currencies.id')
            ->join('currencies as mycurrency', 'invoice_charges.currency_id_mycurrency', '=', 'mycurrency.id')
            ->where('invoice_charges.id', '=', $id)
            ->get();

        return $invoicecharges;
    }

    public function store(Request $request)
    {
        $id = $request->id;

            if ($id == 0) { // create
    
                $invoicecharge = new invoice_charges();
            } else { // update
    
                $invoicecharge = invoice_charges::find($id);
            }


        try {
            $invoicecharge->invoice_id = $request->invoice_id;
            $invoicecharge->description = $request->description;
            $invoicecharge->unit = $request->unit;
            $invoicecharge->unit_cost = $request->unit_cost;
            $invoicecharge->unit_charge = $request->unit_charge;
            $invoicecharge->amount = $request->amount;
            $invoicecharge->currency_id = $request->currency_id;
            $invoicecharge->currency_id_mycurrency = $request->currency_id_mycurrency;
            $invoicecharge->exchange_rate = $request->exchange_rate;
            $invoicecharge->amount_in = $request->amount_in;
            $invoicecharge->tax_description = $request->tax_description;
            $invoicecharge->tax = $request->tax;
            $invoicecharge->tax_amount = $request->tax_amount;
            $invoicecharge->amount_final = $request->amount_final;
            $invoicecharge->total_cost = $request->total_cost;
            $invoicecharge->total_cost_in = $request->total_cost_in;
            $invoicecharge->profit = $request->profit;
            $invoicecharge->profit_in = $request->profit_in;
            $invoicecharge->save();

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
