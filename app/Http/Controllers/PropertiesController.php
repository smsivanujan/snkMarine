<?php

namespace App\Http\Controllers;

use App\Models\properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PropertiesController extends Controller
{
    public function index()
    {
        $properties = DB::table('properties')
            ->select(
                'properties.id',
                'properties.property_name',
                'properties.description'
            )
            ->paginate(50);

        return $properties;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $properties = DB::table('properties')
            ->select(
                'properties.id',
                'properties.property_name',
                'properties.description'
            )
            ->where('properties.id', '=', $id)
            ->get();

        return $properties;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'property_name' => 'required|unique:properties,property_name'
            ]);

            $property = new properties();
        } else { // update

            $this->validate($request, [
                'property_name' => 'required|unique:properties,property_name,' . $id
            ]);

            $property = properties::find($id);
        }

        try {
            $property->property_name = $request->property_name;
            $property->description = $request->description;
            $property->save();

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
