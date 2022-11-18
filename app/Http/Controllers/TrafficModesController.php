<?php

namespace App\Http\Controllers;

use App\Models\traffic_modes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TrafficModesController extends Controller
{
    public function index()
    {
        $trafficmodes = DB::table('traffic_modes')
            ->select(
                'traffic_modes.id',
                'traffic_modes.trafficmode_type'
            )
            ->paginate(50);

        return $trafficmodes;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'trafficmode_type' => 'required|unique:traffic_modes,trafficmode_type'
            ]);

            $trafficmode = new traffic_modes();
        } else { // update

            $this->validate($request, [
                'trafficmode_type' => 'required|unique:traffic_modes,trafficmode_type,' . $id
            ]);

            $trafficmode = traffic_modes::find($id);
        }

        try {
            $trafficmode->trafficmode_type = $request->trafficmode_type;
            $trafficmode->save();

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
