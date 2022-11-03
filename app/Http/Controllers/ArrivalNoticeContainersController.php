<?php

namespace App\Http\Controllers;

use App\Models\arrival_notice_containers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArrivalNoticeContainersController extends Controller
{
    public function index()
    {
        $arrivalnoticecontainers = DB::table('arrival_notice_containers')
            ->select(
                'arrival_notice_containers.id',
                'arrival_notice_containers.arrival_notice_id',
                'arrival_notice_containers.equipment_id',
                'arrival_notice_containers.seal_no',
                'arrival_notice_containers.marks',
                'arrival_notice_containers.type_of_unit_id',
                'arrival_noticies.arrival_notice_no',
                'equipments.equipment_number',
                'type_of_units.type_of_unit',
            )
            ->join('arrival_noticies', 'arrival_notice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
            ->join('equipments', 'arrival_notice_containers.equipment_id', '=', 'equipments.id')
            ->join('type_of_units', 'arrival_notice_containers.type_of_unit_id', '=', 'type_of_units.id')
            ->get();

        return $arrivalnoticecontainers;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $arrivalnoticecontainers = DB::table('arrival_notice_containers')
            ->select(
                'arrival_notice_containers.id',
                'arrival_notice_containers.arrival_notice_id',
                'arrival_notice_containers.equipment_id',
                'arrival_notice_containers.seal_no',
                'arrival_notice_containers.marks',
                'arrival_notice_containers.type_of_unit_id',
                'arrival_noticies.arrival_notice_no',
                'equipments.equipment_number',
                'type_of_units.type_of_unit',
            )
            ->join('arrival_noticies', 'arrival_notice_containers.arrival_notice_id', '=', 'arrival_noticies.id')
            ->join('equipments', 'arrival_notice_containers.equipment_id', '=', 'equipments.id')
            ->join('type_of_units', 'arrival_notice_containers.type_of_unit_id', '=', 'type_of_units.id')
            ->where('arrival_noticies.id', '=', $id)
            ->get();

        return $arrivalnoticecontainers;
    }

    public function store(Request $request)
    {
        $id = $request->id;


        if ($id == 0) { // create

            $arrivalnoticecontainers = new arrival_notice_containers();
        } else { // update
            $arrivalnoticecontainers = arrival_notice_containers::find($id);
        }


        try {
            $arrivalnoticecontainers->arrival_notice_id = $request->arrival_notice_id;
            $arrivalnoticecontainers->equipment_id = $request->equipment_id;
            $arrivalnoticecontainers->seal_no = $request->seal_no;
            $arrivalnoticecontainers->marks = $request->marks;
            $arrivalnoticecontainers->type_of_unit_id = $request->type_of_unit_id;
            $arrivalnoticecontainers->save();

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
