<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = DB::table('departments')
            ->select(
                'departments.id',
                'departments.department_name',
                'departments.description',
                'departments.property_id',
                'properties.property_name'
            )
            ->join('properties', 'departments.property_id', '=', 'properties.id')
            ->paginate(50);

        return $departments;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $departments = DB::table('departments')
            ->select(
                'departments.id',
                'departments.department_name',
                'departments.description',
                'departments.property_id',
                'properties.property_name'
            )
            ->join('properties', 'departments.property_id', '=', 'properties.id')
            ->where('departments.id', '=', $id)
            ->get();

        return $departments;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $departments = DB::table('departments')
            ->select(
                'departments.id',
                'departments.department_name',
                'departments.description',
                'departments.property_id',
                'properties.property_name'
            )
            ->join('properties', 'departments.property_id', '=', 'properties.id')
                ->where(function ($q) use ($query) {
                    $q->where('departments.department_name', 'like', '%' . $query . '%')
                    ->orWhere('properties.property_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $departments;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'department_name' => 'required|unique:departments,department_name'
            ]);

            $department = new departments();
        } else { // update

            $this->validate($request, [
                'department_name' => 'required|unique:departments,department_name,' . $id
            ]);

            $department = departments::find($id);
        }

        try {
            $department->department_name = $request->department_name;
            $department->property_id = $request->property_id;
            $department->description = $request->description;
            $department->save();

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
