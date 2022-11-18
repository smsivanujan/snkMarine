<?php

namespace App\Http\Controllers;

use App\Models\type_of_units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TypeOfUnitsController extends Controller
{
    public function index()
    {
        $typeofunits = DB::table('type_of_units')
            ->select(
                'type_of_units.id',
                'type_of_units.type_of_unit'
            )
            ->paginate(50);

        return $typeofunits;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'type_of_unit' => 'required|unique:type_of_units,type_of_unit'
            ]);

            $typeofunit = new type_of_units();
        } else { // update

            $this->validate($request, [
                'type_of_unit' => 'required|unique:type_of_units,type_of_unit,' . $id
            ]);

            $typeofunit = type_of_units::find($id);
        }

        try {
            $typeofunit->type_of_unit = $request->type_of_unit;
            $typeofunit->save();

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
