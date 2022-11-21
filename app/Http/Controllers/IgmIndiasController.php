<?php

namespace App\Http\Controllers;

use App\Models\igm_indias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmIndiasController extends Controller
{
    public function index()
    {
        $igm_indias = DB::table('igm_indias')
            ->select(
                'igm_indias.id',
                'igm_indias.bill_of_landing_id',
                'igm_indias.sender_id',
                'igm_indias.version_no',
                'igm_indias.message_id',
                'igm_indias.sequence',
                'igm_indias.date1',
                'igm_indias.time1',
                'igm_indias.pod1',
                'igm_indias.imo1',
                'igm_indias.call_sign1',
                'igm_indias.igm_india_voyage_id',
                'igm_indias.line_code',
                'igm_indias.line_pan',
                'igm_indias.master_name',
                'igm_indias.pod_code',
                'igm_indias.last_port1',
                'igm_indias.last_port2',
                'igm_indias.last_port3',
                'igm_indias.vessel_type1',
                'igm_indias.poa',
                'igm_indias.cargo_des1',
                'igm_indias.date_time',
                'igm_indias.light_house',
                'igm_indias.igm_india_terminal_id',
                'igm_indias.same_bottom',
                'igm_indias.passenger_list',
                'igm_indias.ship_stores',
                'igm_indias.crew_effect',
                'igm_indias.crew_list',
                'igm_indias.maritime',
                'igm_indias.vessel_name',
                'igm_indias.arrival_date',
                'igm_indias.igm_number',
                'igm_indias.nationality',
                'igm_indias.deleted',
                'bill_of_landings.bill_of_landing_number',
                'igm_india_voyages.voyage',
                'igm_india_terminals.terminal',
                'igm_india_terminals.code'
            )
            ->join('bill_of_landings', 'igm_indias.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('igm_india_voyages', 'igm_indias.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('igm_india_terminals', 'igm_indias.igm_india_terminal_id', '=', 'igm_india_terminals.id')
            ->paginate(50);

        return $igm_indias;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igm_indias = DB::table('igm_indias')
            ->select(
                'igm_indias.id',
                'igm_indias.bill_of_landing_id',
                'igm_indias.sender_id',
                'igm_indias.version_no',
                'igm_indias.message_id',
                'igm_indias.sequence',
                'igm_indias.date1',
                'igm_indias.time1',
                'igm_indias.pod1',
                'igm_indias.imo1',
                'igm_indias.call_sign1',
                'igm_indias.igm_india_voyage_id',
                'igm_indias.line_code',
                'igm_indias.line_pan',
                'igm_indias.master_name',
                'igm_indias.pod_code',
                'igm_indias.last_port1',
                'igm_indias.last_port2',
                'igm_indias.last_port3',
                'igm_indias.vessel_type1',
                'igm_indias.poa',
                'igm_indias.cargo_des1',
                'igm_indias.date_time',
                'igm_indias.light_house',
                'igm_indias.igm_india_terminal_id',
                'igm_indias.same_bottom',
                'igm_indias.passenger_list',
                'igm_indias.ship_stores',
                'igm_indias.crew_effect',
                'igm_indias.crew_list',
                'igm_indias.maritime',
                'igm_indias.vessel_name',
                'igm_indias.arrival_date',
                'igm_indias.igm_number',
                'igm_indias.nationality',
                'igm_indias.deleted',
                'bill_of_landings.bill_of_landing_number',
                'igm_india_voyages.voyage',
                'igm_india_terminals.terminal',
                'igm_india_terminals.code'
            )
            ->join('bill_of_landings', 'igm_indias.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('igm_india_voyages', 'igm_indias.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('igm_india_terminals', 'igm_indias.igm_india_terminal_id', '=', 'igm_india_terminals.id')
            ->where('igm_indias.id', '=', $id)
            ->get();

        return $igm_indias;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $igm_indias = DB::table('igm_indias')
                ->select(
                    'igm_indias.id',
                    'igm_indias.bill_of_landing_id',
                    'igm_indias.sender_id',
                    'igm_indias.version_no',
                    'igm_indias.message_id',
                    'igm_indias.sequence',
                    'igm_indias.date1',
                    'igm_indias.time1',
                    'igm_indias.pod1',
                    'igm_indias.imo1',
                    'igm_indias.call_sign1',
                    'igm_indias.igm_india_voyage_id',
                    'igm_indias.line_code',
                    'igm_indias.line_pan',
                    'igm_indias.master_name',
                    'igm_indias.pod_code',
                    'igm_indias.last_port1',
                    'igm_indias.last_port2',
                    'igm_indias.last_port3',
                    'igm_indias.vessel_type1',
                    'igm_indias.poa',
                    'igm_indias.cargo_des1',
                    'igm_indias.date_time',
                    'igm_indias.light_house',
                    'igm_indias.igm_india_terminal_id',
                    'igm_indias.same_bottom',
                    'igm_indias.passenger_list',
                    'igm_indias.ship_stores',
                    'igm_indias.crew_effect',
                    'igm_indias.crew_list',
                    'igm_indias.maritime',
                    'igm_indias.vessel_name',
                    'igm_indias.arrival_date',
                    'igm_indias.igm_number',
                    'igm_indias.nationality',
                    'igm_indias.deleted',
                    'bill_of_landings.bill_of_landing_number',
                    'igm_india_voyages.voyage',
                    'igm_india_terminals.terminal',
                    'igm_india_terminals.code'
                )
                ->join('bill_of_landings', 'igm_indias.bill_of_landing_id', '=', 'bill_of_landings.id')
                ->join('igm_india_voyages', 'igm_indias.igm_india_voyage_id', '=', 'igm_india_voyages.id')
                ->join('igm_india_terminals', 'igm_indias.igm_india_terminal_id', '=', 'igm_india_terminals.id')
                ->where(function ($q) use ($query) {
                    $q->where('igm_indias.version_no', 'like', '%' . $query . '%')
                        ->orWhere('bill_of_landings.bill_of_landing_number', 'like', '%' . $query . '%')
                        ->orWhere('igm_india_voyages.voyage', 'like', '%' . $query . '%')
                        ->orWhere('igm_india_terminals.terminal', 'like', '%' . $query . '%')
                        ->orWhere('igm_india_terminals.code', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $igm_indias;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_indias = new igm_indias();
        } else { // update

            $igm_indias = igm_indias::find($id);
        }


        try {
            $igm_indias->bill_of_landing_id = $request->bill_of_landing_id;
            $igm_indias->sender_id = $request->sender_id;
            $igm_indias->version_no = $request->version_no;
            $igm_indias->message_id = $request->message_id;
            $igm_indias->sequence = $request->sequence;
            $igm_indias->date1 = $request->date1;
            $igm_indias->time1 = $request->time1;
            $igm_indias->pod1 = $request->pod1;
            $igm_indias->imo1 = $request->imo1;
            $igm_indias->call_sign1 = $request->call_sign1;
            $igm_indias->igm_india_voyage_id = $request->igm_india_voyage_id;
            $igm_indias->line_code = $request->line_code;
            $igm_indias->line_pan = $request->line_pan;
            $igm_indias->master_name = $request->master_name;
            $igm_indias->pod_code = $request->pod_code;
            $igm_indias->last_port1 = $request->last_port1;
            $igm_indias->last_port2 = $request->last_port2;
            $igm_indias->last_port3 = $request->last_port3;
            $igm_indias->vessel_type1 = $request->vessel_type1;
            $igm_indias->poa = $request->poa;
            $igm_indias->cargo_des1 = $request->cargo_des1;
            $igm_indias->date_time = $request->date_time;
            $igm_indias->light_house = $request->light_house;
            $igm_indias->igm_india_terminal_id = $request->igm_india_terminal_id;
            $igm_indias->same_bottom = $request->same_bottom;
            $igm_indias->passenger_list = $request->passenger_list;
            $igm_indias->ship_stores = $request->ship_stores;
            $igm_indias->crew_effect = $request->crew_effect;
            $igm_indias->crew_list = $request->crew_list;
            $igm_indias->maritime = $request->maritime;
            $igm_indias->vessel_name = $request->vessel_name;
            $igm_indias->arrival_date = $request->arrival_date;
            $igm_indias->igm_number = $request->igm_number;
            $igm_indias->nationality = $request->nationality;
            $igm_indias->deleted = $request->deleted;
            $igm_indias->save();


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

        $igmindia = igm_indias::find($id);
        $igmindia->deleted = $status;
        $igmindia->save();

        return 'Done';
    }
}
