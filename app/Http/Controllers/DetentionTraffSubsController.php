<?php

namespace App\Http\Controllers;

use App\Models\detention_traff_subs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DetentionTraffSubsController extends Controller
{
    public function index()
    {
        $detentiontraffsubs = DB::table('detention_traff_subs')
            ->select(
                'detention_traff_subs.id',
                'detention_traff_subs.detention_traffic_id',
                'detention_traff_subs.tariff_name',
                'detention_traff_subs.slab_days',
                'detention_traff_subs.slab_rate',
                'detention_traff_subs.deleted',
                'yard.vendor_code',
                'yard.vendor_name',
                'agent.client_code',
                'agent.client_name'
            )
            ->join('detention_traffies', 'detention_traff_subs.detention_traffic_id', '=', 'detention_traffies.id')
            ->join('typeofunits', 'detention_traff_subs.typeofunit_id', '=', 'typeofunits.id')
            ->join('vendors as yard', 'detention_traff_subs.vendor_id_yard', '=', 'yard.id')
            ->join('clients as agent', 'detention_traff_subs.client_id_agent', '=', 'agent.id')
            ->get();

        return $detentiontraffsubs;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $detentiontraffsubs = DB::table('detention_traff_subs')
        ->select(
            'detention_traff_subs.id',
            'detention_traff_subs.detention_traffic_id',
            'detention_traff_subs.tariff_name',
            'detention_traff_subs.slab_days',
            'detention_traff_subs.slab_rate',
            'detention_traff_subs.deleted',
            'yard.vendor_code',
            'yard.vendor_name',
            'agent.client_code',
            'agent.client_name'
        )
        ->join('detention_traffies', 'detention_traff_subs.detention_traffic_id', '=', 'detention_traffies.id')
        ->join('typeofunits', 'detention_traff_subs.typeofunit_id', '=', 'typeofunits.id')
        ->join('vendors as yard', 'detention_traff_subs.vendor_id_yard', '=', 'yard.id')
        ->join('clients as agent', 'detention_traff_subs.client_id_agent', '=', 'agent.id')
            ->where('detention_traffies.id', '=', $id)
            ->get();

        return $detentiontraffsubs;
    }

    public function store(Request $request)
    {
        $id = $request->id;

            $detentiontraffsub = new detention_traff_subs();


        try {
            $detentiontraffsub->detention_traffic_id = $request->detention_traffic_id;
            $detentiontraffsub->tariff_name = $request->tariff_name;
            $detentiontraffsub->slab_days = $request->slab_days;
            $detentiontraffsub->slab_rate = $request->slab_rate;
            $detentiontraffsub->deleted = $request->deleted;
            $detentiontraffsub->save();

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
