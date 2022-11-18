<?php

namespace App\Http\Controllers;

use App\Models\detention_invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DetentionInvoicesController extends Controller
{
    public function index()
    {
        $detentioninvoices = DB::table('detention_invoices')
            ->select(
                'detention_invoices.id',
                'detention_invoices.date',
                'detention_invoices.detention_no',
                'detention_invoices.bill_of_landing_id',
                'detention_invoices.client_id_shipper',
                'detention_invoices.client_id_consignee',
                'detention_invoices.client_id',
                'detention_invoices.port_id_loading',
                'detention_invoices.port_id_discharge',
                'detention_invoices.igm_india_voyage_id',
                'detention_invoices.etd_pol',
                'detention_invoices.eta_pod',
                'detention_invoices.st_expire',
                'detention_invoices.ata_fpd',
                'detention_invoices.obl_no',
                'detention_invoices.remarks',
                'detention_invoices.total_days_detention',
                'detention_invoices.discount_type',
                'detention_invoices.discount_input',
                'detention_invoices.previous_bill',
                'detention_invoices.total_amount',
                'detention_invoices.final_amount',
                'detention_invoices.nos_units',
                'detention_invoices.grand_total',
                'detention_invoices.grand_total_this_invoice_unit',
                'detention_invoices.payed',
                'detention_invoices.yard_suppose_date',
                'detention_invoices.forign_currency_id',
                'detention_invoices.tariff_id',
                'detention_invoices.bl_free_days',
                'detention_invoices.exchange_rate',
                'detention_invoices.final_amount_tarrif',
                'detention_invoices.local_currency_id',
                'detention_invoices.comm',
                'detention_invoices.status',
                'detention_invoices.status2',
                'detention_invoices.deleted',
                'shipper.client_code',
                'shipper.client_name',
                'consignee.client_code',
                'consignee.client_name',
                'clients.client_code',
                'clients.client_name',
                'portloading.port_code',
                'portloading.port_name',
                'discharge.port_code',
                'discharge.port_name',
                'igm_india_voyages.voyage',
                'forign.currency_code',
                'forign.currency_name'
                // 'local.currency_code',
                // 'local.currency_name'

            )
            ->join('bill_of_landings', 'detention_invoices.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'detention_invoices.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'detention_invoices.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'detention_invoices.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'detention_invoices.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'detention_invoices.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'detention_invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('detention_traffies', 'detention_invoices.tariff_id', '=', 'detention_traffies.id')
            ->join('currencies as forign', 'detention_invoices.forign_currency_id', '=', 'forign.id')
            // ->join('currencies as local ', 'detention_invoices.local_currency_id', '=', 'local.id')
            ->paginate(50);

        return $detentioninvoices;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $detentioninvoices = DB::table('detention_invoices')
            ->select(
                'detention_invoices.id',
                'detention_invoices.date',
                'detention_invoices.detention_no',
                'detention_invoices.bill_of_landing_id',
                'detention_invoices.client_id_shipper',
                'detention_invoices.client_id_consignee',
                'detention_invoices.client_id',
                'detention_invoices.port_id_loading',
                'detention_invoices.port_id_discharge',
                'detention_invoices.igm_india_voyage_id',
                'detention_invoices.etd_pol',
                'detention_invoices.eta_pod',
                'detention_invoices.st_expire',
                'detention_invoices.ata_fpd',
                'detention_invoices.obl_no',
                'detention_invoices.remarks',
                'detention_invoices.total_days_detention',
                'detention_invoices.discount_type',
                'detention_invoices.discount_input',
                'detention_invoices.previous_bill',
                'detention_invoices.total_amount',
                'detention_invoices.final_amount',
                'detention_invoices.nos_units',
                'detention_invoices.grand_total',
                'detention_invoices.grand_total_this_invoice_unit',
                'detention_invoices.payed',
                'detention_invoices.yard_suppose_date',
                'detention_invoices.forign_currency_id',
                'detention_invoices.tariff_id',
                'detention_invoices.bl_free_days',
                'detention_invoices.exchange_rate',
                'detention_invoices.final_amount_tarrif',
                'detention_invoices.local_currency_id',
                'detention_invoices.comm',
                'detention_invoices.status',
                'detention_invoices.status2',
                'detention_invoices.deleted',
                'shipper.client_code',
                'shipper.client_name',
                'consignee.client_code',
                'consignee.client_name',
                'clients.client_code',
                'clients.client_name',
                'portloading.port_code',
                'portloading.port_name',
                'discharge.port_code',
                'discharge.port_name',
                'igm_india_voyages.voyage',
                'forign.currency_code',
                'forign.currency_name'
                // 'local.currency_code',
                // 'local.currency_name'

            )
            ->join('bill_of_landings', 'detention_invoices.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'detention_invoices.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'detention_invoices.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'detention_invoices.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'detention_invoices.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'detention_invoices.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'detention_invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('detention_traffies', 'detention_invoices.tariff_id', '=', 'detention_traffies.id')
            ->join('currencies as forign', 'detention_invoices.forign_currency_id', '=', 'forign.id')
            // ->join('currencies as local ', 'detention_invoices.local_currency_id', '=', 'local.id')
            ->where('detention_invoices.id', '=', $id)
            ->get();

        return $detentioninvoices;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'detention_no' => 'required|unique:detention_invoices,detention_no',
            ]);


            $detentioninvoice = new detention_invoices();
        } else { // update

            $this->validate($request, [
                'detention_no' => 'required|unique:detention_invoices,detention_no,' . $id
            ]);

            $detentioninvoice = detention_invoices::find($id);
        }

        try {
            $detentioninvoice->date = $request->date;
            $detentioninvoice->detention_no = $request->detention_no;
            $detentioninvoice->bill_of_landing_id = $request->bill_of_landing_id;
            $detentioninvoice->client_id_shipper = $request->client_id_shipper;
            $detentioninvoice->client_id_consignee = $request->client_id_consignee;
            $detentioninvoice->client_id = $request->client_id;
            $detentioninvoice->port_id_loading = $request->port_id_loading;
            $detentioninvoice->port_id_discharge = $request->port_id_discharge;
            $detentioninvoice->igm_india_voyage_id = $request->igm_india_voyage_id;
            $detentioninvoice->etd_pol = $request->etd_pol;
            $detentioninvoice->eta_pod = $request->eta_pod;
            $detentioninvoice->st_expire = $request->st_expire;
            $detentioninvoice->ata_fpd = $request->ata_fpd;
            $detentioninvoice->obl_no = $request->obl_no;
            $detentioninvoice->remarks = $request->remarks;
            $detentioninvoice->total_days_detention = $request->total_days_detention;
            $detentioninvoice->discount_type = $request->discount_type;
            $detentioninvoice->previous_bill = $request->previous_bill;
            $detentioninvoice->discount_input = $request->discount_input;
            $detentioninvoice->total_amount = $request->total_amount;
            $detentioninvoice->final_amount = $request->final_amount;
            $detentioninvoice->nos_units = $request->nos_units;
            $detentioninvoice->grand_total = $request->grand_total;
            $detentioninvoice->grand_total_this_invoice_unit = $request->grand_total_this_invoice_unit;
            $detentioninvoice->total_days_detention = $request->total_days_detention;
            $detentioninvoice->payed = $request->payed;
            $detentioninvoice->yard_suppose_date = $request->yard_suppose_date;
            $detentioninvoice->forign_currency_id = $request->forign_currency_id;
            $detentioninvoice->tariff_id = $request->tariff_id;
            $detentioninvoice->bl_free_days = $request->bl_free_days;
            $detentioninvoice->exchange_rate = $request->exchange_rate;
            $detentioninvoice->final_amount_tarrif = $request->final_amount_tarrif;
            $detentioninvoice->local_currency_id = $request->local_currency_id;
            $detentioninvoice->comm = $request->comm;
            $detentioninvoice->status = $request->status;
            $detentioninvoice->status2 = $request->status2;
            $detentioninvoice->deleted = $request->deleted;
            $detentioninvoice->save();

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

        $detentioninvoice = detention_invoices::find($id);
        $detentioninvoice->deleted = $status;
        $detentioninvoice->save();

        return 'Done';
    }
}
