<?php

namespace App\Http\Controllers;

use App\Models\access_points;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccessPointsController extends Controller
{

    public function index()
    {
        $accesspoints = DB::table('access_points')
            ->select(
                'access_points.id',
                'access_points.display_name',
                'access_points.value',
                'access_points.access_model_id',
                'access_models.name',
            )
            ->join('access_models', 'access_points.access_model_id', '=', 'access_models.id')
            ->paginate(50);

        return $accesspoints;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        $accesspoints = DB::table('access_points')
        ->select(
            'access_points.id',
            'access_points.display_name',
            'access_points.value',
            'access_points.access_model_id',
            'access_models.name',
        )
        ->join('access_models', 'access_points.access_model_id', '=', 'access_models.id');

        if ($request->get('query')) {
            $query = $request->get('query');

           
            $accesspoints=$accesspoints->where(function ($q) use ($query) {
                    $q->where('access_points.display_name', 'like', '%' . $query . '%')
                        ->orWhere('access_points.value', 'like', '%' . $query . '%')
                        ->orWhere('access_models.name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $accesspoints;
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

        $accesspoints = DB::table('access_points')
            ->select(
                'access_points.id',
                'access_points.display_name',
                'access_points.value',
                'access_points.access_model_id',
                'access_models.name',
            )
            ->join('access_models', 'access_points.access_model_id', '=', 'access_models.id');

        if (!empty($request->access_model_id) && empty($request->id)) {
            // return "1";
            // id empty
             $accesspoints = $accesspoints
             ->where('access_models.id', '=', $request->access_model_id);
        }
        elseif (empty($request->access_model_id) && !empty($request->id)) {
            // return "2";
            // access_model_id empty
            $accesspoints = $accesspoints->where('access_points.id', '=', $request->id);
        }
        elseif (!empty($request->access_model_id) && !empty($request->id)) {
            // return "3";
            // no empty
            $accesspoints = $accesspoints
            ->where('access_models.id', '=', $request->access_model_id)
            ->where('access_points.id', '=', $request->id);
        }
        else
        {
            // return "4";
            //all empty
            $accesspoints = $accesspoints;
        }

        $result = $accesspoints->orderBy('access_points.id')
            ->get();
        return $result;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'display_name' => 'required|unique:access_points,display_name'
            ]);

            $accesspoint = new access_points();
        } else { // update

            $this->validate($request, [
                'display_name' => 'required|unique:access_points,display_name,' . $id
            ]);

            $accesspoint = access_points::find($id);
        }

        try {
            $accesspoint->display_name = $request->display_name;
            $accesspoint->value = $request->value;
            $accesspoint->access_model_id = $request->access_model_id;
            $accesspoint->save();

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
