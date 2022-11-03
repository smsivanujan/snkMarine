<?php

namespace App\Http\Controllers;

use App\Models\igm_india_weights;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmIndiaWeightsController extends Controller
{
    public function index()
    {
        $igm_india_weights = DB::table('igm_india_weights')
            ->select(
                'igm_india_weights.id',
                'igm_india_weights.weight'
            )
            ->get();

        return $igm_india_weights;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igm_india_weights = DB::table('igm_india_weights')
        ->select(
            'igm_india_weights.id',
            'igm_india_weights.weight'
        )
            ->where('igm_india_weights.id', '=', $id)
            ->get();

        return $igm_india_weights;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_india_weights = new igm_india_weights();
        } else { // update

            $igm_india_weights = igm_india_weights::find($id);
        }


        try {
            $igm_india_weights->weight = $request->weight;
            $igm_india_weights->save();


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
