<?php

namespace App\Http\Controllers;

use App\Models\access_models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccessModelsController extends Controller
{
    public function index()
    {
        $accessmodels = DB::table('access_models')
            ->select(
                'access_models.id',
                'access_models.name'
            )
            ->paginate(50);

        return $accessmodels;
    }

    public function search()
    {
        $accessmodels = DB::table('access_models')
            ->select(
                'access_models.id',
                'access_models.name'
            )
            ->where('access_models.name' like "")
            ->paginate(50);

        return $accessmodels;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'name' => 'required|unique:access_models,name',
            ]);

            $accessmodel = new access_models();
        } else { // update

            $this->validate($request, [
                'name' => 'required|unique:access_models,name,' . $id,
            ]);

            $accessmodel = access_models::find($id);
        }

        try {
            $accessmodel->name = $request->name;
            $accessmodel->save();

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
