<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = DB::table('invoices')
            ->select(
                'invoices.id',
                'invoices.date',
                'invoices.invoice_no',
                'invoices.bill_of_landing_id',
                'invoices.client_id_shipper',
                'invoices.client_id_consignee',
                'invoices.client_id',
                'invoices.port_id_loading',
                'invoices.port_id_discharge',
                'invoices.igm_india_voyage_id',
                'invoices.etd_pol',
                'invoices.eta_pod',
                'invoices.st_expire',
                'invoices.ata_fpd',
                'invoices.obl_no',
                'invoices.shipment_type',
                'invoices.hbl_no',
                'invoices.carrier',
                'invoices.nos_units',
                'invoices.weight',
                'invoices.cbm',
                'invoices.remarks',
                'invoices.usd_rate',
                'invoices.usd_tot',
                'invoices.status',
                'invoices.tax_invoice',
                'invoices.deleted',
                'bill_of_landings.bill_of_landing_number',
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
                'igm_india_voyages.voyage'
            )
            ->join('bill_of_landings', 'invoices.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'invoices.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'invoices.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'invoices.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'invoices.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->paginate(50);

        return $invoices;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $invoices = DB::table('invoices')
            ->select(
                'invoices.id',
                'invoices.date',
                'invoices.invoice_no',
                'invoices.bill_of_landing_id',
                'invoices.client_id_shipper',
                'invoices.client_id_consignee',
                'invoices.client_id',
                'invoices.port_id_loading',
                'invoices.port_id_discharge',
                'invoices.igm_india_voyage_id',
                'invoices.etd_pol',
                'invoices.eta_pod',
                'invoices.st_expire',
                'invoices.ata_fpd',
                'invoices.obl_no',
                'invoices.shipment_type',
                'invoices.hbl_no',
                'invoices.carrier',
                'invoices.nos_units',
                'invoices.weight',
                'invoices.cbm',
                'invoices.remarks',
                'invoices.usd_rate',
                'invoices.usd_tot',
                'invoices.status',
                'invoices.tax_invoice',
                'invoices.deleted',
                'bill_of_landings.bill_of_landing_number',
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
                'igm_india_voyages.voyage'
            )
            ->join('bill_of_landings', 'invoices.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'invoices.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'invoices.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'invoices.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'invoices.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->where('invoices.id', '=', $id)
            ->get();

        return $invoices;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $invoices = DB::table('invoices')
            ->select(
                'invoices.id',
                'invoices.date',
                'invoices.invoice_no',
                'invoices.bill_of_landing_id',
                'invoices.client_id_shipper',
                'invoices.client_id_consignee',
                'invoices.client_id',
                'invoices.port_id_loading',
                'invoices.port_id_discharge',
                'invoices.igm_india_voyage_id',
                'invoices.etd_pol',
                'invoices.eta_pod',
                'invoices.st_expire',
                'invoices.ata_fpd',
                'invoices.obl_no',
                'invoices.shipment_type',
                'invoices.hbl_no',
                'invoices.carrier',
                'invoices.nos_units',
                'invoices.weight',
                'invoices.cbm',
                'invoices.remarks',
                'invoices.usd_rate',
                'invoices.usd_tot',
                'invoices.status',
                'invoices.tax_invoice',
                'invoices.deleted',
                'bill_of_landings.bill_of_landing_number',
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
                'bill_of_landings.bill_of_landing_number'

            )
            ->join('bill_of_landings', 'invoices.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'invoices.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'invoices.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'invoices.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'invoices.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->where(function ($q) use ($query) {
                $q->where('invoices.invoice_no', 'like', '%' . $query . '%')
                ->orWhere('invoices.date', 'like', '%' . $query . '%')
                ->orWhere('invoices.obl_no', 'like', '%' . $query . '%')
                ->orWhere('bill_of_landings.bill_of_landing_number', 'like', '%' . $query . '%')
                ->orWhere('shipper.client_name', 'like', '%' . $query . '%')
                ->orWhere('shipper.client_name', 'like', '%' . $query . '%')
                ->orWhere('consignee.client_name', 'like', '%' . $query . '%')
                ->orWhere('consignee.client_name', 'like', '%' . $query . '%')
                ->orWhere('clients.client_name', 'like', '%' . $query . '%')
                ->orWhere('clients.client_name', 'like', '%' . $query . '%')
                ->orWhere('portloading.port_code', 'like', '%' . $query . '%')
                ->orWhere('portloading.port_name', 'like', '%' . $query . '%')
                ->orWhere('discharge.port_code', 'like', '%' . $query . '%')
                ->orWhere('discharge.port_name', 'like', '%' . $query . '%')
                ->orWhere('igm_india_voyages.voyage', 'like', '%' . $query . '%');
            })
                ->get();
        }

        return $invoices;
    }

    public function showByFilter(Request $request)
    {
        $fdate = isset($request->fdate) ? $request->fdate : date('Y-m-d');
        $tdate = isset($request->tdate) ? $request->tdate : date('Y-m-d');

        $invoices = DB::table('invoices')
            ->select(
                'invoices.id',
                'invoices.date',
                'invoices.invoice_no',
                'invoices.bill_of_landing_id',
                'invoices.client_id_shipper',
                'invoices.client_id_consignee',
                'invoices.client_id',
                'invoices.port_id_loading',
                'invoices.port_id_discharge',
                'invoices.igm_india_voyage_id',
                'invoices.etd_pol',
                'invoices.eta_pod',
                'invoices.st_expire',
                'invoices.ata_fpd',
                'invoices.obl_no',
                'invoices.shipment_type',
                'invoices.hbl_no',
                'invoices.carrier',
                'invoices.nos_units',
                'invoices.weight',
                'invoices.cbm',
                'invoices.remarks',
                'invoices.usd_rate',
                'invoices.usd_tot',
                'invoices.status',
                'invoices.tax_invoice',
                'invoices.deleted',
                'bill_of_landings.bill_of_landing_number',
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
                'igm_india_voyages.voyage'
            )
            ->join('bill_of_landings', 'invoices.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'invoices.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'invoices.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'invoices.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'invoices.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'invoices.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->where(DB::raw('DATE_FORMAT(invoices.date, "%Y-%m-%d")'), '>=', $fdate)
            ->where(DB::raw('DATE_FORMAT(invoices.date, "%Y-%m-%d")'), '<=', $tdate);

       if (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id)) {
 
            $invoices = $invoices
                ->where('invoices.bill_of_landing_id', '=', $request->bill_of_landing_id)
                ->where('invoices.client_id', '=', $request->client_id)
                ->where('invoices.port_id_loading', '=', $request->port_id_loading)
                ->where('invoices.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        } elseif (!empty($request->bill_of_landing_id) && empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id)) {
        
            $invoices = $invoices
                ->where('invoices.bill_of_landing_id', '=', $request->bill_of_landing_id)
                ->where('invoices.port_id_loading', '=', $request->port_id_loading)
                ->where('invoices.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && empty($request->port_id_loading) && !empty($request->igm_india_voyage_id)) {
           
            $invoices = $invoices
                ->where('invoices.bill_of_landing_id', '=', $request->bill_of_landing_id)
                ->where('invoices.client_id', '=', $request->client_id)
                ->where('invoices.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && empty($request->igm_india_voyage_id)) {
         
            $invoices = $invoices
                ->where('invoices.bill_of_landing_id', '=', $request->bill_of_landing_id)
                ->where('invoices.client_id', '=', $request->client_id)
                ->where('invoices.port_id_loading', '=', $request->port_id_loading);
        } elseif (!empty($request->bill_of_landing_id) && empty($request->client_id) && empty($request->port_id_loading) && empty($request->igm_india_voyage_id)) {
           
            $invoices = $invoices
                ->where('invoices.bill_of_landing_id', '=', $request->bill_of_landing_id);
        } elseif (empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id)) {
           
            $invoices = $invoices
                ->where('invoices.client_id', '=', $request->client_id)
                ->where('invoices.port_id_loading', '=', $request->port_id_loading)
                ->where('invoices.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        } elseif (empty($request->bill_of_landing_id) && !empty($request->client_id) && empty($request->port_id_loading) && !empty($request->igm_india_voyage_id)) {
           
            $invoices = $invoices
                ->where('invoices.client_id', '=', $request->client_id)
                ->where('invoices.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        } elseif (empty($request->bill_of_landing_id) && !empty($request->client_id) && empty($request->port_id_loading) && empty($request->igm_india_voyage_id)) {
           
            $invoices = $invoices
                ->where('invoices.client_id', '=', $request->client_id);
        } elseif (empty($request->bill_of_landing_id) && empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id)) {
           
            $invoices = $invoices
                ->where('invoices.port_id_loading', '=', $request->port_id_loading)
                ->where('invoices.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        } elseif (empty($request->bill_of_landing_id) && empty($request->client_id) && !empty($request->port_id_loading) && empty($request->igm_india_voyage_id)) {
            
            $invoices = $invoices
                ->where('invoices.port_id_loading', '=', $request->port_id_loading);
        } elseif (empty($request->bill_of_landing_id) && empty($request->client_id) && empty($request->port_id_loading) && !empty($request->igm_india_voyage_id)) {
          
            $invoices = $invoices
                ->where('invoices.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        } else {
            
            $invoices = $invoices;
        }

        $result = $invoices->orderBy('invoices.id')
            ->get();
        return $result;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'invoice_no' => 'required|unique:invoices,invoice_no',
            ]);


            $invoice = new invoices();
        } else { // update

            $this->validate($request, [
                'invoice_no' => 'required|unique:invoices,invoice_no,' . $id
            ]);

            $invoice = invoices::find($id);
        }

        try {
            $invoice->date = $request->date;
            $invoice->invoice_no = $request->invoice_no;
            $invoice->bill_of_landing_id = $request->bill_of_landing_id;
            $invoice->client_id_shipper = $request->client_id_shipper;
            $invoice->client_id_consignee = $request->client_id_consignee;
            $invoice->client_id = $request->client_id;
            $invoice->port_id_loading = $request->port_id_loading;
            $invoice->port_id_discharge = $request->port_id_discharge;
            $invoice->igm_india_voyage_id = $request->igm_india_voyage_id;
            $invoice->etd_pol = $request->etd_pol;
            $invoice->eta_pod = $request->eta_pod;
            $invoice->st_expire = $request->st_expire;
            $invoice->ata_fpd = $request->ata_fpd;
            $invoice->obl_no = $request->obl_no;
            $invoice->shipment_type = $request->shipment_type;
            $invoice->hbl_no = $request->hbl_no;
            $invoice->carrier = $request->carrier;
            $invoice->nos_units = $request->nos_units;
            $invoice->weight = $request->weight;
            $invoice->cbm = $request->cbm;
            $invoice->remarks = $request->remarks;
            $invoice->usd_rate = $request->usd_rate;
            $invoice->usd_tot = $request->usd_tot;
            $invoice->status = $request->status;
            $invoice->tax_invoice = $request->tax_invoice;
            $invoice->deleted = $request->deleted;
            $invoice->save();

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

        $invoice = invoices::find($id);
        $invoice->deleted = $status;
        $invoice->save();

        return 'Done';
    }
}
