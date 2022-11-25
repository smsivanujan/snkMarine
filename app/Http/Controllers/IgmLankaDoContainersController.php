<?php

namespace App\Http\Controllers;

use App\Models\igm_lanka_do_containers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmLankaDoContainersController extends Controller
{
    public function index()
    {
        $igm_lanka_do_containers = DB::table('igm_lanka_do_containers')
            ->select(
                'igm_lanka_do_containers.id',
                'igm_lanka_do_containers.igm_id',
                'igm_lanka_do_containers.equipment_id',
                'igm_lanka_do_containers.seal_no',
                'igm_lanka_do_containers.description',
                'igm_lanka_do_containers.weight',
                'igm_lanka_do_containers.measurement',
                'equipments.equipment_number'
            )
            ->join('igms', 'igm_lanka_do_containers.igm_id', '=', 'igms.id')
            ->join('equipments', 'igm_lanka_do_containers.equipment_id', '=', 'equipments.id')
            ->paginate(50);

        return $igm_lanka_do_containers;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igm_lanka_do_containers = DB::table('igm_lanka_do_containers')
            ->select(
                'igm_lanka_do_containers.id',
                'igm_lanka_do_containers.igm_id',
                'igm_lanka_do_containers.equipment_id',
                'igm_lanka_do_containers.seal_no',
                'igm_lanka_do_containers.description',
                'igm_lanka_do_containers.weight',
                'igm_lanka_do_containers.measurement',
                'equipments.equipment_number'
            )
            ->join('igms', 'igm_lanka_do_containers.igm_id', '=', 'igms.id')
            ->join('equipments', 'igm_lanka_do_containers.equipment_id', '=', 'equipments.id')
            ->where('igm_lanka_do_containers.id', '=', $id)
            ->get();

        return $igm_lanka_do_containers;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $igm_lanka_do_containers = DB::table('igm_lanka_do_containers')
                ->select(
                    'igm_lanka_do_containers.id',
                    'igm_lanka_do_containers.igm_id',
                    'igm_lanka_do_containers.equipment_id',
                    'igm_lanka_do_containers.seal_no',
                    'igm_lanka_do_containers.description',
                    'igm_lanka_do_containers.weight',
                    'igm_lanka_do_containers.measurement',
                    'equipments.equipment_number',
                    'igms.customs_office_code'
                )
                ->join('igms', 'igm_lanka_do_containers.igm_id', '=', 'igms.id')
                ->join('equipments', 'igm_lanka_do_containers.equipment_id', '=', 'equipments.id')
                ->where(function ($q) use ($query) {
                    $q->where('igm_lanka_do_containers.seal_no', 'like', '%' . $query . '%')
                        ->orWhere('equipments.equipment_number', 'like', '%' . $query . '%')
                        ->orWhere('igms.customs_office_code', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $igm_lanka_do_containers;
    }

    public function showByFilter(Request $request)
    {
        // $id = $request->id;

        $igm_lanka_do_containers = DB::table('igm_lanka_do_containers')
            ->select(
                'igm_lanka_do_containers.id',
                'igm_lanka_do_containers.igm_id',
                'igm_lanka_do_containers.equipment_id',
                'igm_lanka_do_containers.seal_no',
                'igm_lanka_do_containers.description',
                'igm_lanka_do_containers.weight',
                'igm_lanka_do_containers.measurement',
                'equipments.equipment_number'
            )
            ->join('igms', 'igm_lanka_do_containers.igm_id', '=', 'igms.id')
            ->join('equipments', 'igm_lanka_do_containers.equipment_id', '=', 'equipments.id');

        if (!empty($request->igm_id) && !empty($request->equipment_id)) {

             $igm_lanka_do_containers = $igm_lanka_do_containers
             ->where('igm_lanka_do_containers.igm_id', '=', $request->igm_id)
             ->where('igm_lanka_do_containers.equipment_id', '=', $request->equipment_id);
        }
        elseif (!empty($request->igm_id) && empty($request->equipment_id)) {

            $igm_lanka_do_containers = $igm_lanka_do_containers
            ->where('igm_lanka_do_containers.igm_id', '=', $request->igm_id);
        }
        elseif (empty($request->igm_id) && !empty($request->equipment_id)) {

            $igm_lanka_do_containers = $igm_lanka_do_containers
            ->where('igm_lanka_do_containers.equipment_id', '=', $request->equipment_id);
        }
        else
        {

            $igm_lanka_do_containers = $igm_lanka_do_containers;
        }

        $result = $igm_lanka_do_containers->orderBy('igm_lanka_do_containers.id')
            ->get();
        return $result;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_lanka_do_containers = new igm_lanka_do_containers();
        } else { // update

            $igm_lanka_do_containers = igm_lanka_do_containers::find($id);
        }


        try {
            $igm_lanka_do_containers->igm_id = $request->igm_id;
            $igm_lanka_do_containers->equipment_id = $request->equipment_id;
            $igm_lanka_do_containers->seal_no = $request->seal_no;
            $igm_lanka_do_containers->description = $request->description;
            $igm_lanka_do_containers->weight = $request->weight;
            $igm_lanka_do_containers->measurement = $request->measurement;
            $igm_lanka_do_containers->save();


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
