<?php

namespace App\Http\Controllers;

use App\Models\igm_india_cfs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmIndiaCfsController extends Controller
{
    public function index()
    {
        $igmindiacfs = DB::table('igm_india_cfs')
            ->select(
                'igm_india_cfs.id',
                'igm_india_cfs.cfs_code'
            )
            ->paginate(50);

        return $igmindiacfs;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igmindiacfs = DB::table('igm_india_cfs')
            ->select(
                'igm_india_cfs.id',
                'igm_india_cfs.cfs_code'
            )
            ->where('igm_india_cfs.id', '=', $id)
            ->get();

        return $igmindiacfs;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $igmindiacfs = DB::table('igm_india_cfs')
            ->select(
                'igm_india_cfs.id',
                'igm_india_cfs.cfs_code'
            )
            ->where(function ($q) use ($query) {
                $q->where('igm_india_cfs.cfs_code', 'like', '%' . $query . '%');
            })
                ->get();
        }

        return $igmindiacfs;
    }

    public function store(Request $request)
    {
        $id = $request->id;


        if ($id == 0) { // create

            $igm_india_cfs = new igm_india_cfs();
        } else { // update

            $igm_india_cfs = igm_india_cfs::find($id);
        }



        try {
            $igm_india_cfs->cfs_code = $request->cfs_code;
            $igm_india_cfs->save();

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
