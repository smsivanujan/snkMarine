<?php

namespace App\Http\Controllers;

use App\Models\booking_confirmations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingConfirmationsController extends Controller
{
    public function index()
    {
        $bookingconfirmations = DB::table('booking_confirmations')
            ->select(
                'booking_confirmations.id',
                'booking_confirmations.date',
                'booking_confirmations.booking_confirmation_number',
                'booking_confirmations.client_id_shipper',
                'booking_confirmations.client_id',
                'booking_confirmations.port_net_ref',
                'booking_confirmations.vendor_id',
                'booking_confirmations.port_id_loading',
                'booking_confirmations.port_id_discharge',
                'booking_confirmations.place_of_delivery',
                'booking_confirmations.place_of_receipt',
                'booking_confirmations.description',
                'booking_confirmations.eta',
                'booking_confirmations.closing_date',
                'booking_confirmations.etd',
                'booking_confirmations.eta_pod',
                'booking_confirmations.igm_india_voyage_id',
                'booking_confirmations.voyage_number',
                'booking_confirmations.measurement',
                'booking_confirmations.type_of_shipment',
                'booking_confirmations.release_reference',
                'booking_confirmations.gross_weight',
                'booking_confirmations.type_of_unit_id',
                'booking_confirmations.vendor_id_yard',
                'booking_confirmations.quantity_of_unit',
                'booking_confirmations.release_expire',
                'booking_confirmations.remarks',
                'booking_confirmations.status_1',
                'booking_confirmations.status_2',
                'shipper.client_code',
                'shipper.client_name',
                'clients.client_code',
                'clients.client_name',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'portloading.port_code',
                'portloading.port_name',
                'portloading.sub_code',
                'portloading.country_id',
                'portdischarge.port_code',
                'portdischarge.port_name',
                'portdischarge.sub_code',
                'portdischarge.country_id',
                'Cload.country_name',
                'Cload.capital_city_name',
                'Cdischarge.country_name',
                'Cdischarge.capital_city_name',
                'igm_india_voyages.voyage',
                'type_of_units.type_of_unit',
                'yard.vendor_code',
                'yard.vendor_name'
            )
            ->join('clients as shipper', 'booking_confirmations.client_id_shipper', '=', 'shipper.id')
            ->join('clients', 'booking_confirmations.client_id', '=', 'clients.id')
            ->join('vendors', 'booking_confirmations.vendor_id', '=', 'vendors.id')
            ->join('ports as portloading', 'booking_confirmations.port_id_loading', '=', 'portloading.id')
            ->join('ports as portdischarge', 'booking_confirmations.port_id_discharge', '=', 'portdischarge.id')
            ->join('countries as Cload', 'portloading.country_id', '=', 'Cload.id')
            ->join('countries as Cdischarge', 'portdischarge.country_id', '=', 'Cdischarge.id')
            ->join('igm_india_voyages', 'booking_confirmations.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('type_of_units', 'booking_confirmations.type_of_unit_id', '=', 'type_of_units.id')
            ->join('vendors as yard', 'booking_confirmations.vendor_id_yard', '=', 'yard.id')
            ->paginate(50);

        return $bookingconfirmations;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $bookingconfirmations = DB::table('booking_confirmations')
            ->select(
                'booking_confirmations.id',
                'booking_confirmations.date',
                'booking_confirmations.booking_confirmation_number',
                'booking_confirmations.client_id_shipper',
                'booking_confirmations.client_id',
                'booking_confirmations.port_net_ref',
                'booking_confirmations.vendor_id',
                'booking_confirmations.port_id_loading',
                'booking_confirmations.port_id_discharge',
                'booking_confirmations.place_of_delivery',
                'booking_confirmations.place_of_receipt',
                'booking_confirmations.description',
                'booking_confirmations.eta',
                'booking_confirmations.closing_date',
                'booking_confirmations.etd',
                'booking_confirmations.eta_pod',
                'booking_confirmations.igm_india_voyage_id',
                'booking_confirmations.voyage_number',
                'booking_confirmations.measurement',
                'booking_confirmations.type_of_shipment',
                'booking_confirmations.release_reference',
                'booking_confirmations.gross_weight',
                'booking_confirmations.type_of_unit_id',
                'booking_confirmations.vendor_id_yard',
                'booking_confirmations.quantity_of_unit',
                'booking_confirmations.release_expire',
                'booking_confirmations.remarks',
                'booking_confirmations.status_1',
                'booking_confirmations.status_2',
                'shipper.client_code',
                'shipper.client_name',
                'clients.client_code',
                'clients.client_name',
                'vendors.vendor_code',
                'vendors.vendor_name',
                'portloading.port_code',
                'portloading.port_name',
                'portloading.sub_code',
                'portloading.country_id',
                'portdischarge.port_code',
                'portdischarge.port_name',
                'portdischarge.sub_code',
                'portdischarge.country_id',
                'Cload.country_name',
                'Cload.capital_city_name',
                'Cdischarge.country_name',
                'Cdischarge.capital_city_name',
                'igm_india_voyages.voyage',
                'type_of_units.type_of_unit',
                'yard.vendor_code',
                'yard.vendor_name'
            )
            ->join('clients as shipper', 'booking_confirmations.client_id_shipper', '=', 'shipper.id')
            ->join('clients', 'booking_confirmations.client_id', '=', 'clients.id')
            ->join('vendors', 'booking_confirmations.vendor_id', '=', 'vendors.id')
            ->join('ports as portloading', 'booking_confirmations.port_id_loading', '=', 'portloading.id')
            ->join('ports as portdischarge', 'booking_confirmations.port_id_discharge', '=', 'portdischarge.id')
            ->join('countries as Cload', 'portloading.country_id', '=', 'Cload.id')
            ->join('countries as Cdischarge', 'portdischarge.country_id', '=', 'Cdischarge.id')
            ->join('igm_india_voyages', 'booking_confirmations.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('type_of_units', 'booking_confirmations.type_of_unit_id', '=', 'type_of_units.id')
            ->join('vendors as yard', 'booking_confirmations.vendor_id_yard', '=', 'yard.id')
            ->where('booking_confirmations.id', '=', $id)
            ->get();

        return $bookingconfirmations;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $bookingconfirmations = DB::table('booking_confirmations')
                ->select(
                    'booking_confirmations.id',
                    'booking_confirmations.date',
                    'booking_confirmations.booking_confirmation_number',
                    'booking_confirmations.client_id_shipper',
                    'booking_confirmations.client_id',
                    'booking_confirmations.port_net_ref',
                    'booking_confirmations.vendor_id',
                    'booking_confirmations.port_id_loading',
                    'booking_confirmations.port_id_discharge',
                    'booking_confirmations.place_of_delivery',
                    'booking_confirmations.place_of_receipt',
                    'booking_confirmations.description',
                    'booking_confirmations.eta',
                    'booking_confirmations.closing_date',
                    'booking_confirmations.etd',
                    'booking_confirmations.eta_pod',
                    'booking_confirmations.igm_india_voyage_id',
                    'booking_confirmations.voyage_number',
                    'booking_confirmations.measurement',
                    'booking_confirmations.type_of_shipment',
                    'booking_confirmations.release_reference',
                    'booking_confirmations.gross_weight',
                    'booking_confirmations.type_of_unit_id',
                    'booking_confirmations.vendor_id_yard',
                    'booking_confirmations.quantity_of_unit',
                    'booking_confirmations.release_expire',
                    'booking_confirmations.remarks',
                    'booking_confirmations.status_1',
                    'booking_confirmations.status_2',
                    'shipper.client_code',
                    'shipper.client_name',
                    'clients.client_code',
                    'clients.client_name',
                    'vendors.vendor_code',
                    'vendors.vendor_name',
                    'portloading.port_code',
                    'portloading.port_name',
                    'portloading.sub_code',
                    'portloading.country_id',
                    'portdischarge.port_code',
                    'portdischarge.port_name',
                    'portdischarge.sub_code',
                    'portdischarge.country_id',
                    'Cload.country_name',
                    'Cload.capital_city_name',
                    'Cdischarge.country_name',
                    'Cdischarge.capital_city_name',
                    'igm_india_voyages.voyage',
                    'type_of_units.type_of_unit',
                    'yard.vendor_code',
                    'yard.vendor_name'
                )
                ->join('clients as shipper', 'booking_confirmations.client_id_shipper', '=', 'shipper.id')
                ->join('clients', 'booking_confirmations.client_id', '=', 'clients.id')
                ->join('vendors', 'booking_confirmations.vendor_id', '=', 'vendors.id')
                ->join('ports as portloading', 'booking_confirmations.port_id_loading', '=', 'portloading.id')
                ->join('ports as portdischarge', 'booking_confirmations.port_id_discharge', '=', 'portdischarge.id')
                ->join('countries as Cload', 'portloading.country_id', '=', 'Cload.id')
                ->join('countries as Cdischarge', 'portdischarge.country_id', '=', 'Cdischarge.id')
                ->join('igm_india_voyages', 'booking_confirmations.igm_india_voyage_id', '=', 'igm_india_voyages.id')
                ->join('type_of_units', 'booking_confirmations.type_of_unit_id', '=', 'type_of_units.id')
                ->join('vendors as yard', 'booking_confirmations.vendor_id_yard', '=', 'yard.id')
                ->where(function ($q) use ($query) {
                    $q->where('booking_confirmations.booking_confirmation_number', 'like', '%' . $query . '%')
                        ->orWhere('booking_confirmations.date', 'like', '%' . $query . '%')
                        ->orWhere('shipper.client_code', 'like', '%' . $query . '%')
                        ->orWhere('shipper.client_name', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%')
                        ->orWhere('portloading.port_code', 'like', '%' . $query . '%')
                        ->orWhere('portloading.port_name', 'like', '%' . $query . '%')
                        ->orWhere('portdischarge.port_code', 'like', '%' . $query . '%')
                        ->orWhere('portdischarge.port_name', 'like', '%' . $query . '%')
                        ->orWhere('Cload.country_name', 'like', '%' . $query . '%')
                        ->orWhere('Cdischarge.country_name', 'like', '%' . $query . '%')
                        ->orWhere('igm_india_voyages.voyage', 'like', '%' . $query . '%')
                        ->orWhere('type_of_units.type_of_unit', 'like', '%' . $query . '%')
                        ->orWhere('yard.vendor_code', 'like', '%' . $query . '%')
                        ->orWhere('yard.vendor_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $bookingconfirmations;
    }

    public function showByFilter(Request $request)
    {
        // $fdate = isset($request->fdate) ? $request->fdate : date('Y-m-d');
        // $tdate = isset($request->tdate) ? $request->tdate : date('Y-m-d');

        // $bookingconfirmations = DB::table('booking_confirmations')
        //     ->select(
        //         'booking_confirmations.id',
        //         'booking_confirmations.date',
        //         'booking_confirmations.booking_confirmation_number',
        //         'booking_confirmations.client_id_shipper',
        //         'booking_confirmations.client_id',
        //         'booking_confirmations.port_net_ref',
        //         'booking_confirmations.vendor_id',
        //         'booking_confirmations.port_id_loading',
        //         'booking_confirmations.port_id_discharge',
        //         'booking_confirmations.place_of_delivery',
        //         'booking_confirmations.place_of_receipt',
        //         'booking_confirmations.description',
        //         'booking_confirmations.eta',
        //         'booking_confirmations.closing_date',
        //         'booking_confirmations.etd',
        //         'booking_confirmations.eta_pod',
        //         'booking_confirmations.igm_india_voyage_id',
        //         'booking_confirmations.voyage_number',
        //         'booking_confirmations.measurement',
        //         'booking_confirmations.type_of_shipment',
        //         'booking_confirmations.release_reference',
        //         'booking_confirmations.gross_weight',
        //         'booking_confirmations.type_of_unit_id',
        //         'booking_confirmations.vendor_id_yard',
        //         'booking_confirmations.quantity_of_unit',
        //         'booking_confirmations.release_expire',
        //         'booking_confirmations.remarks',
        //         'booking_confirmations.status_1',
        //         'booking_confirmations.status_2',
        //         'shipper.client_code',
        //         'shipper.client_name',
        //         'clients.client_code',
        //         'clients.client_name',
        //         'vendors.vendor_code',
        //         'vendors.vendor_name',
        //         'portloading.port_code',
        //         'portloading.port_name',
        //         'portloading.sub_code',
        //         'portloading.country_id',
        //         'portdischarge.port_code',
        //         'portdischarge.port_name',
        //         'portdischarge.sub_code',
        //         'portdischarge.country_id',
        //         'Cload.country_name',
        //         'Cload.capital_city_name',
        //         'Cdischarge.country_name',
        //         'Cdischarge.capital_city_name',
        //         'igm_india_voyages.voyage',
        //         'type_of_units.type_of_unit',
        //         'yard.vendor_code',
        //         'yard.vendor_name'
        //     )
        //     ->join('clients as shipper', 'booking_confirmations.client_id_shipper', '=', 'shipper.id')
        //     ->join('clients', 'booking_confirmations.client_id', '=', 'clients.id')
        //     ->join('vendors', 'booking_confirmations.vendor_id', '=', 'vendors.id')
        //     ->join('ports as portloading', 'booking_confirmations.port_id_loading', '=', 'portloading.id')
        //     ->join('ports as portdischarge', 'booking_confirmations.port_id_discharge', '=', 'portdischarge.id')
        //     ->join('countries as Cload', 'portloading.country_id', '=', 'Cload.id')
        //     ->join('countries as Cdischarge', 'portdischarge.country_id', '=', 'Cdischarge.id')
        //     ->join('igm_india_voyages', 'booking_confirmations.igm_india_voyage_id', '=', 'igm_india_voyages.id')
        //     ->join('type_of_units', 'booking_confirmations.type_of_unit_id', '=', 'type_of_units.id')
        //     ->join('vendors as yard', 'booking_confirmations.vendor_id_yard', '=', 'yard.id')
        //     ->where(DB::raw('DATE_FORMAT(booking_confirmations.date, "%Y-%m-%d")'), '>=', $fdate)
        //     ->where(DB::raw('DATE_FORMAT(booking_confirmations.date, "%Y-%m-%d")'), '<=', $tdate);

        // if (!empty($request->access_model_id) && empty($request->id) && !empty($request->access_model_id) && empty($request->id)) {
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

            $bookingconfirmation = new booking_confirmations();
        } else { // update

            $bookingconfirmation = booking_confirmations::find($id);
        }

        try {
            $bookingconfirmation->date = $request->date;
            $bookingconfirmation->booking_confirmation_number = $request->booking_confirmation_number;
            $bookingconfirmation->client_id_shipper = $request->client_id_shipper;
            $bookingconfirmation->client_id = $request->client_id;
            $bookingconfirmation->port_net_ref = $request->port_net_ref;
            $bookingconfirmation->vendor_id = $request->vendor_id;
            $bookingconfirmation->port_id_loading = $request->port_id_loading;
            $bookingconfirmation->port_id_discharge = $request->port_id_discharge;
            $bookingconfirmation->place_of_delivery = $request->place_of_delivery;
            $bookingconfirmation->place_of_receipt = $request->place_of_receipt;
            $bookingconfirmation->description = $request->description;
            $bookingconfirmation->eta = $request->eta;
            $bookingconfirmation->closing_date = $request->closing_date;
            $bookingconfirmation->etd = $request->etd;
            $bookingconfirmation->eta_pod = $request->eta_pod;
            $bookingconfirmation->igm_india_voyage_id = $request->igm_india_voyage_id;
            $bookingconfirmation->voyage_number = $request->voyage_number;
            $bookingconfirmation->measurement = $request->measurement;
            $bookingconfirmation->type_of_shipment = $request->type_of_shipment;
            $bookingconfirmation->release_reference = $request->release_reference;
            $bookingconfirmation->gross_weight = $request->gross_weight;
            $bookingconfirmation->type_of_unit_id = $request->type_of_unit_id;
            $bookingconfirmation->vendor_id_yard = $request->vendor_id_yard;
            $bookingconfirmation->quantity_of_unit = $request->quantity_of_unit;
            $bookingconfirmation->release_expire = $request->release_expire;
            $bookingconfirmation->remarks = $request->remarks;
            $bookingconfirmation->status_1 = $request->status_1;
            $bookingconfirmation->status_2 = $request->status_2;
            $bookingconfirmation->save();

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
