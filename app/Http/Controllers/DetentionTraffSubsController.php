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
                'detention_traff_subs.deleted'
            )
            ->join('detention_traffies', 'detention_traff_subs.detention_traffic_id', '=', 'detention_traffies.id')
            ->paginate(50);

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
                'detention_traff_subs.deleted'
            )
            ->join('detention_traffies', 'detention_traff_subs.detention_traffic_id', '=', 'detention_traffies.id')
            ->where('detention_traffies.id', '=', $id)
            ->get();

        return $detentiontraffsubs;
    }

    public function store(Request $request)
    {
        $id = $request->id;
        if ($id == 0) { // create

            $detentiontraffsub = new detention_traff_subs();
        } else { // update

            $detentiontraffsub = detention_traff_subs::find($id);
        }


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

        $detentiontraffsub = detention_traff_subs::find($id);
        $detentiontraffsub->deleted = $status;
        $detentiontraffsub->save();

        return 'Done';
    }
}
