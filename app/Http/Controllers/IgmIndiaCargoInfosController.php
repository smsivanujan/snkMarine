<?php

namespace App\Http\Controllers;

use App\Models\igm_india_cargo_infos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmIndiaCargoInfosController extends Controller
{
    public function index()
    {
        $igm_india_cargo_infos = DB::table('igm_india_cargo_infos')
            ->select(
                'igm_india_cargo_infos.id',
                'igm_india_cargo_infos.igm_id',
                'igm_india_cargo_infos.pod2',
                'igm_india_cargo_infos.imo2',
                'igm_india_cargo_infos.call_sign2',
                'igm_india_cargo_infos.igm_india_voyage_id',
                'igm_india_cargo_infos.line_number',
                'igm_india_cargo_infos.bill_of_landing_id',
                'igm_india_cargo_infos.pol_code',
                'igm_india_cargo_infos.pol_code_sub',
                'igm_india_cargo_infos.final_destination',
                'igm_india_cargo_infos.vessel_type2',
                'igm_india_cargo_infos.other_cargo',
                'igm_india_cargo_infos.local_cargo',
                'igm_india_cargo_infos.local_sfc',
                'igm_india_cargo_infos.total_packages',
                'igm_india_cargo_infos.pkg_units',
                'igm_india_cargo_infos.total_gross',
                'igm_india_cargo_infos.gross_units',
                'igm_india_cargo_infos.marks_numbers',
                'igm_india_cargo_infos.cargo_des2',
                'igm_india_cargo_infos.cargo_class',
                'igm_india_cargo_infos.ul_number',
                'igm_india_cargo_infos.rail_number',
                'igm_india_cargo_infos.rail_operator',
                'igm_india_cargo_infos.train_road',
                'igm_india_cargo_infos.pan_number',
                'igm_india_cargo_infos.client_id_consignee',
                'igm_india_cargo_infos.client_id_notify',
                'igm_india_cargo_infos.unit_count',
                'igm_india_cargo_infos.shipping_from',
                'igm_india_cargo_infos.remarks',
            )
            ->join('igms', 'igm_india_cargo_infos.igm_id', '=', 'igms.id')
            ->join('igm_india_voyages', 'igm_india_cargo_infos.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('bill_of_landings', 'igm_india_cargo_infos.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as consignee', 'igm_india_cargo_infos.client_id_consignee', '=', 'consignee.id')
            ->join('clients as notify', 'igm_india_cargo_infos.client_id_notify', '=', 'notify.id')
            ->get();

        return $igm_india_cargo_infos;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igm_india_cargo_infos = DB::table('igm_india_cargo_infos')
        ->select(
            'igm_india_cargo_infos.id',
            'igm_india_cargo_infos.igm_id',
            'igm_india_cargo_infos.pod2',
            'igm_india_cargo_infos.imo2',
            'igm_india_cargo_infos.call_sign2',
            'igm_india_cargo_infos.igm_india_voyage_id',
            'igm_india_cargo_infos.line_number',
            'igm_india_cargo_infos.bill_of_landing_id',
            'igm_india_cargo_infos.pol_code',
            'igm_india_cargo_infos.pol_code_sub',
            'igm_india_cargo_infos.final_destination',
            'igm_india_cargo_infos.vessel_type2',
            'igm_india_cargo_infos.other_cargo',
            'igm_india_cargo_infos.local_cargo',
            'igm_india_cargo_infos.local_sfc',
            'igm_india_cargo_infos.total_packages',
            'igm_india_cargo_infos.pkg_units',
            'igm_india_cargo_infos.total_gross',
            'igm_india_cargo_infos.gross_units',
            'igm_india_cargo_infos.marks_numbers',
            'igm_india_cargo_infos.cargo_des2',
            'igm_india_cargo_infos.cargo_class',
            'igm_india_cargo_infos.ul_number',
            'igm_india_cargo_infos.rail_number',
            'igm_india_cargo_infos.rail_operator',
            'igm_india_cargo_infos.train_road',
            'igm_india_cargo_infos.pan_number',
            'igm_india_cargo_infos.client_id_consignee',
            'igm_india_cargo_infos.client_id_notify',
            'igm_india_cargo_infos.unit_count',
            'igm_india_cargo_infos.shipping_from',
            'igm_india_cargo_infos.remarks',
        )
        ->join('igms', 'igm_india_cargo_infos.igm_id', '=', 'igms.id')
        ->join('igm_india_voyages', 'igm_india_cargo_infos.igm_india_voyage_id', '=', 'igm_india_voyages.id')
        ->join('bill_of_landings', 'igm_india_cargo_infos.bill_of_landing_id', '=', 'bill_of_landings.id')
        ->join('clients as consignee', 'igm_india_cargo_infos.client_id_consignee', '=', 'consignee.id')
        ->join('clients as notify', 'igm_india_cargo_infos.client_id_notify', '=', 'notify.id')
            ->where('igm_india_cargo_infos.id', '=', $id)
            ->get();

        return $igm_india_cargo_infos;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_india_cargo_infos = new igm_india_cargo_infos();
        } else { // update

            $igm_india_cargo_infos = igm_india_cargo_infos::find($id);
        }



        try {
            $igm_india_cargo_infos->igm_id = $request->igm_id;
            $igm_india_cargo_infos->pod2 = $request->pod2;
            $igm_india_cargo_infos->imo2 = $request->imo2;
            $igm_india_cargo_infos->call_sign2 = $request->call_sign2;
            $igm_india_cargo_infos->igm_india_voyage_id = $request->igm_india_voyage_id;
            $igm_india_cargo_infos->line_number = $request->line_number;
            $igm_india_cargo_infos->bill_of_landing_id = $request->bill_of_landing_id;
            $igm_india_cargo_infos->pol_code = $request->pol_code;
            $igm_india_cargo_infos->pol_code_sub = $request->pol_code_sub;
            $igm_india_cargo_infos->final_destination = $request->final_destination;
            $igm_india_cargo_infos->vessel_type2 = $request->vessel_type2;
            $igm_india_cargo_infos->other_cargo = $request->other_cargo;
            $igm_india_cargo_infos->local_cargo = $request->local_cargo;
            $igm_india_cargo_infos->local_sfc = $request->local_sfc;
            $igm_india_cargo_infos->total_packages = $request->total_packages;
            $igm_india_cargo_infos->pkg_units = $request->pkg_units;
            $igm_india_cargo_infos->total_gross = $request->total_gross;
            $igm_india_cargo_infos->marks_numbers = $request->marks_numbers;
            $igm_india_cargo_infos->cargo_des2 = $request->cargo_des2;
            $igm_india_cargo_infos->cargo_class = $request->cargo_class;
            $igm_india_cargo_infos->ul_number = $request->ul_number;
            $igm_india_cargo_infos->rail_number = $request->rail_number;
            $igm_india_cargo_infos->rail_operator = $request->rail_operator;
            $igm_india_cargo_infos->train_road = $request->train_road;
            $igm_india_cargo_infos->pan_number = $request->pan_number;
            $igm_india_cargo_infos->client_id_consignee = $request->client_id_consignee;
            $igm_india_cargo_infos->client_id_notify = $request->client_id_notify;
            $igm_india_cargo_infos->unit_count = $request->unit_count;
            $igm_india_cargo_infos->shipping_from = $request->shipping_from;
            $igm_india_cargo_infos->remarks = $request->remarks;
            $igm_india_cargo_infos->save();


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
