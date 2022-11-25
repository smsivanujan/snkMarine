<?php

namespace App\Http\Controllers;

use App\Models\arrival_noticies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArrivalNoticiesController extends Controller
{
    public function index()
    {
        $arrivalnoticies = DB::table('arrival_noticies')
            ->select(
                'arrival_noticies.id',
                'arrival_noticies.date',
                'arrival_noticies.arrival_notice_no',
                'arrival_noticies.bill_of_landing_id',
                'arrival_noticies.client_id_shipper',
                'arrival_noticies.client_id_consignee',
                'arrival_noticies.client_id',
                'arrival_noticies.port_id_loading',
                'arrival_noticies.port_id_discharge',
                'arrival_noticies.igm_india_voyage_id',
                'arrival_noticies.etd_pol',
                'arrival_noticies.eta_pod',
                'arrival_noticies.st_expire',
                'arrival_noticies.ata_fpd',
                'arrival_noticies.obl_no',
                'arrival_noticies.shipment_type',
                'arrival_noticies.hbl_no',
                'arrival_noticies.carrier',
                'arrival_noticies.nos_units',
                'arrival_noticies.weight',
                'arrival_noticies.vendor_id_yard',
                'arrival_noticies.remarks',
                'arrival_noticies.status',
                'arrival_noticies.usd_rate',
                'arrival_noticies.usd_tot',
                'arrival_noticies.deleted',
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
                'yard.vendor_code',
                'yard.vendor_name'
            )
            ->join('bill_of_landings', 'arrival_noticies.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'arrival_noticies.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'arrival_noticies.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'arrival_noticies.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'arrival_noticies.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'arrival_noticies.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'arrival_noticies.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('vendors as yard', 'arrival_noticies.vendor_id_yard', '=', 'yard.id')
            ->paginate(50);

        return $arrivalnoticies;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $arrivalnoticies = DB::table('arrival_noticies')
            ->select(
                'arrival_noticies.id',
                'arrival_noticies.date',
                'arrival_noticies.arrival_notice_no',
                'arrival_noticies.bill_of_landing_id',
                'arrival_noticies.client_id_shipper',
                'arrival_noticies.client_id_consignee',
                'arrival_noticies.client_id',
                'arrival_noticies.port_id_loading',
                'arrival_noticies.port_id_discharge',
                'arrival_noticies.igm_india_voyage_id',
                'arrival_noticies.etd_pol',
                'arrival_noticies.eta_pod',
                'arrival_noticies.st_expire',
                'arrival_noticies.ata_fpd',
                'arrival_noticies.obl_no',
                'arrival_noticies.shipment_type',
                'arrival_noticies.hbl_no',
                'arrival_noticies.carrier',
                'arrival_noticies.nos_units',
                'arrival_noticies.weight',
                'arrival_noticies.vendor_id_yard',
                'arrival_noticies.remarks',
                'arrival_noticies.status',
                'arrival_noticies.usd_rate',
                'arrival_noticies.usd_tot',
                'arrival_noticies.deleted',
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
                'yard.vendor_code',
                'yard.vendor_name',

            )
            ->join('bill_of_landings', 'arrival_noticies.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as shipper', 'arrival_noticies.client_id_shipper', '=', 'shipper.id')
            ->join('clients as consignee', 'arrival_noticies.client_id_consignee', '=', 'consignee.id')
            ->join('clients', 'arrival_noticies.client_id', '=', 'clients.id')
            ->join('ports as portloading', 'arrival_noticies.port_id_loading', '=', 'portloading.id')
            ->join('ports as discharge', 'arrival_noticies.port_id_discharge', '=', 'discharge.id')
            ->join('igm_india_voyages', 'arrival_noticies.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('vendors as yard', 'arrival_noticies.vendor_id_yard', '=', 'yard.id')
            ->where('arrival_noticies.id', '=', $id)
            ->get();

        return $arrivalnoticies;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $arrivalnoticies = DB::table('arrival_noticies')
                ->select(
                    'arrival_noticies.id',
                    'arrival_noticies.date',
                    'arrival_noticies.arrival_notice_no',
                    'arrival_noticies.bill_of_landing_id',
                    'arrival_noticies.client_id_shipper',
                    'arrival_noticies.client_id_consignee',
                    'arrival_noticies.client_id',
                    'arrival_noticies.port_id_loading',
                    'arrival_noticies.port_id_discharge',
                    'arrival_noticies.igm_india_voyage_id',
                    'arrival_noticies.etd_pol',
                    'arrival_noticies.eta_pod',
                    'arrival_noticies.st_expire',
                    'arrival_noticies.ata_fpd',
                    'arrival_noticies.obl_no',
                    'arrival_noticies.shipment_type',
                    'arrival_noticies.hbl_no',
                    'arrival_noticies.carrier',
                    'arrival_noticies.nos_units',
                    'arrival_noticies.weight',
                    'arrival_noticies.vendor_id_yard',
                    'arrival_noticies.remarks',
                    'arrival_noticies.status',
                    'arrival_noticies.usd_rate',
                    'arrival_noticies.usd_tot',
                    'arrival_noticies.deleted',
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
                    'yard.vendor_code',
                    'yard.vendor_name',

                )
                ->join('bill_of_landings', 'arrival_noticies.bill_of_landing_id', '=', 'bill_of_landings.id')
                ->join('clients as shipper', 'arrival_noticies.client_id_shipper', '=', 'shipper.id')
                ->join('clients as consignee', 'arrival_noticies.client_id_consignee', '=', 'consignee.id')
                ->join('clients', 'arrival_noticies.client_id', '=', 'clients.id')
                ->join('ports as portloading', 'arrival_noticies.port_id_loading', '=', 'portloading.id')
                ->join('ports as discharge', 'arrival_noticies.port_id_discharge', '=', 'discharge.id')
                ->join('igm_india_voyages', 'arrival_noticies.igm_india_voyage_id', '=', 'igm_india_voyages.id')
                ->join('vendors as yard', 'arrival_noticies.vendor_id_yard', '=', 'yard.id')
                ->where(function ($q) use ($query) {
                    $q->where('arrival_noticies.arrival_notice_no', 'like', '%' . $query . '%')
                        ->orWhere('arrival_noticies.date', 'like', '%' . $query . '%')
                        ->orWhere('bill_of_landings.bill_of_landing_number', 'like', '%' . $query . '%')
                        ->orWhere('shipper.client_code', 'like', '%' . $query . '%')
                        ->orWhere('shipper.client_name', 'like', '%' . $query . '%')
                        ->orWhere('consignee.client_code', 'like', '%' . $query . '%')
                        ->orWhere('consignee.client_name', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%')
                        ->orWhere('portloading.port_code', 'like', '%' . $query . '%')
                        ->orWhere('portloading.port_name', 'like', '%' . $query . '%')
                        ->orWhere('discharge.port_code', 'like', '%' . $query . '%')
                        ->orWhere('discharge.port_name', 'like', '%' . $query . '%')
                        ->orWhere('yard.vendor_code', 'like', '%' . $query . '%')
                        ->orWhere('yard.vendor_name', 'like', '%' . $query . '%')
                        ->orWhere('igm_india_voyages.voyage', 'like', '%' . $query . '%');
                })
                ->get();

            return $arrivalnoticies;
        }
    }

    public function showByFilter(Request $request)
    {
        // $fdate = isset($request->fdate) ? $request->fdate : date('Y-m-d');
        // $tdate = isset($request->tdate) ? $request->tdate : date('Y-m-d');

        // $arrivalnoticies = DB::table('arrival_noticies')
        //     ->select(
        //         'arrival_noticies.id',
        //         'arrival_noticies.date',
        //         'arrival_noticies.arrival_notice_no',
        //         'arrival_noticies.bill_of_landing_id',
        //         'arrival_noticies.client_id_shipper',
        //         'arrival_noticies.client_id_consignee',
        //         'arrival_noticies.client_id',
        //         'arrival_noticies.port_id_loading',
        //         'arrival_noticies.port_id_discharge',
        //         'arrival_noticies.igm_india_voyage_id',
        //         'arrival_noticies.etd_pol',
        //         'arrival_noticies.eta_pod',
        //         'arrival_noticies.st_expire',
        //         'arrival_noticies.ata_fpd',
        //         'arrival_noticies.obl_no',
        //         'arrival_noticies.shipment_type',
        //         'arrival_noticies.hbl_no',
        //         'arrival_noticies.carrier',
        //         'arrival_noticies.nos_units',
        //         'arrival_noticies.weight',
        //         'arrival_noticies.vendor_id_yard',
        //         'arrival_noticies.remarks',
        //         'arrival_noticies.status',
        //         'arrival_noticies.usd_rate',
        //         'arrival_noticies.usd_tot',
        //         'arrival_noticies.deleted',
        //         'bill_of_landings.bill_of_landing_number',
        //         'shipper.client_code',
        //         'shipper.client_name',
        //         'consignee.client_code',
        //         'consignee.client_name',
        //         'clients.client_code',
        //         'clients.client_name',
        //         'portloading.port_code',
        //         'portloading.port_name',
        //         'discharge.port_code',
        //         'discharge.port_name',
        //         'igm_india_voyages.voyage',
        //         'yard.vendor_code',
        //         'yard.vendor_name'
        //     )
        //     ->join('bill_of_landings', 'arrival_noticies.bill_of_landing_id', '=', 'bill_of_landings.id')
        //     ->join('clients as shipper', 'arrival_noticies.client_id_shipper', '=', 'shipper.id')
        //     ->join('clients as consignee', 'arrival_noticies.client_id_consignee', '=', 'consignee.id')
        //     ->join('clients', 'arrival_noticies.client_id', '=', 'clients.id')
        //     ->join('ports as portloading', 'arrival_noticies.port_id_loading', '=', 'portloading.id')
        //     ->join('ports as discharge', 'arrival_noticies.port_id_discharge', '=', 'discharge.id')
        //     ->join('igm_india_voyages', 'arrival_noticies.igm_india_voyage_id', '=', 'igm_india_voyages.id')
        //     ->join('vendors as yard', 'arrival_noticies.vendor_id_yard', '=', 'yard.id')
        //     ->where(DB::raw('DATE_FORMAT(arrival_noticies.date, "%Y-%m-%d")'), '>=', $fdate)
        //     ->where(DB::raw('DATE_FORMAT(arrival_noticies.date, "%Y-%m-%d")'), '<=', $tdate)

        // if (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.bill_of_landing_id', '=', $request->bill_of_landing_id)
        //         ->where('arrivalnoticies.client_id', '=', $request->client_id)
        //         ->where('arrivalnoticies.port_id_loading', '=', $request->port_id_loading)
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.bill_of_landing_id', '=', $request->bill_of_landing_id)
        //         ->where('arrivalnoticies.port_id_loading', '=', $request->port_id_loading)
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.bill_of_landing_id', '=', $request->bill_of_landing_id)
        //         ->where('arrivalnoticies.client_id', '=', $request->client_id)
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.bill_of_landing_id', '=', $request->bill_of_landing_id)
        //         ->where('arrivalnoticies.client_id', '=', $request->client_id)
        //         ->where('arrivalnoticies.port_id_loading', '=', $request->port_id_loading);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.bill_of_landing_id', '=', $request->bill_of_landing_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.client_id', '=', $request->client_id)
        //         ->where('arrivalnoticies.port_id_loading', '=', $request->port_id_loading)
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.client_id', '=', $request->client_id)
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.client_id', '=', $request->client_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.port_id_loading', '=', $request->port_id_loading)
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.port_id_loading', '=', $request->port_id_loading);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } elseif (!empty($request->bill_of_landing_id) && !empty($request->client_id) && !empty($request->port_id_loading) && !empty($request->igm_india_voyage_id) && !empty($request->vendor_id_yard)) {

        //     $arrivalnoticies = $arrivalnoticies
        //         ->where('arrivalnoticies.igm_india_voyage_id', '=', $request->igm_india_voyage_id);
        // } else {

        //     $arrivalnoticies = $arrivalnoticies;
        // }

        // $result = $arrivalnoticies->orderBy('access_points.id')
        //     ->get();
        // return $result;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'arrival_notice_no' => 'required|unique:arrival_noticies,arrival_notice_no',
            ]);


            $arrivalnoticies = new arrival_noticies();
        } else { // update

            $this->validate($request, [
                'arrival_notice_no' => 'required|unique:arrival_noticies,arrival_notice_no,' . $id
            ]);

            $arrivalnoticies = arrival_noticies::find($id);
        }

        try {
            $arrivalnoticies->date = $request->date;
            $arrivalnoticies->arrival_notice_no = $request->arrival_notice_no;
            $arrivalnoticies->bill_of_landing_id = $request->bill_of_landing_id;
            $arrivalnoticies->client_id_shipper = $request->client_id_shipper;
            $arrivalnoticies->client_id_consignee = $request->client_id_consignee;
            $arrivalnoticies->client_id = $request->client_id;
            $arrivalnoticies->port_id_loading = $request->port_id_loading;
            $arrivalnoticies->port_id_discharge = $request->port_id_discharge;
            $arrivalnoticies->igm_india_voyage_id = $request->igm_india_voyage_id;
            $arrivalnoticies->etd_pol = $request->etd_pol;
            $arrivalnoticies->eta_pod = $request->eta_pod;
            $arrivalnoticies->st_expire = $request->st_expire;
            $arrivalnoticies->ata_fpd = $request->ata_fpd;
            $arrivalnoticies->obl_no = $request->obl_no;
            $arrivalnoticies->shipment_type = $request->shipment_type;
            $arrivalnoticies->hbl_no = $request->hbl_no;
            $arrivalnoticies->carrier = $request->carrier;
            $arrivalnoticies->nos_units = $request->nos_units;
            $arrivalnoticies->weight = $request->weight;
            $arrivalnoticies->vendor_id_yard = $request->vendor_id_yard;
            $arrivalnoticies->remarks = $request->remarks;
            $arrivalnoticies->status = $request->status;
            $arrivalnoticies->usd_rate = $request->usd_rate;
            $arrivalnoticies->usd_tot = $request->usd_tot;
            $arrivalnoticies->deleted = $request->deleted;
            $arrivalnoticies->save();

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

        $arrivalnoticies = arrival_noticies::find($id);
        $arrivalnoticies->deleted = $status;
        $arrivalnoticies->save();

        return 'Done';
    }
}
