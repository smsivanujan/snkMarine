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
            ->get();

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
