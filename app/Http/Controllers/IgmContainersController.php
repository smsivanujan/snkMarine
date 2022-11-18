<?php

namespace App\Http\Controllers;

use App\Models\igm_carriers;
use App\Models\igm_containers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmContainersController extends Controller
{
    public function index()
    {
        $igmcontainers = DB::table('igm_containers')
            ->select(
                'igm_containers.id',
                'igm_containers.igm_id',
                'igm_containers.bill_of_landing_id',
                'igm_containers.no_of_packages',
                'igm_containers.type_of_container',
                'igm_containers.empty_Full',
                'igm_containers.deleted'
            )
            ->join('bill_of_landings', 'igm_containers.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->paginate(50);

        return $igmcontainers;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igmcontainers = DB::table('igm_containers')
            ->select(
                'igm_containers.id',
                'igm_containers.igm_id',
                'igm_containers.bill_of_landing_id',
                'igm_containers.no_of_packages',
                'igm_containers.type_of_container',
                'igm_containers.empty_Full',
                'igm_containers.deleted'
            )
            ->join('bill_of_landings', 'igm_containers.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->where('igm_containers.id', '=', $id)
            ->get();

        return $igmcontainers;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_containers = new igm_containers();
        } else { // update

            $igm_containers = igm_containers::find($id);
        }


        try {
            $igm_containers->igm_id = $request->igm_id;
            $igm_containers->bill_of_landing_id = $request->bill_of_landing_id;
            $igm_containers->no_of_packages = $request->no_of_packages;
            $igm_containers->type_of_container = $request->type_of_container;
            $igm_containers->empty_Full = $request->empty_Full;
            $igm_containers->deleted = $request->deleted;
            $igm_containers->save();


            $data = [
                'is_create' => true,
                'error' => []
            ];

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }

    // status change
    public function statusChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $status = 0;//inactive
        } else {
            $status = 1;//active
        }

        $igmcontainer = igm_containers::find($id);
        $igmcontainer->deleted = $status;
        $igmcontainer->save();

        return 'Done';
    }
}
