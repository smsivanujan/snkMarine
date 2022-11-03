<?php

namespace App\Http\Controllers;

use App\Models\igm_india_terminals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmIndiaTerminalsController extends Controller
{
    public function index()
    {
        $igm_india_terminals = DB::table('igm_india_terminals')
            ->select(
                'igm_india_terminals.id',
                'igm_india_terminals.terminal',
                'igm_india_terminals.code',
                'igm_india_terminals.port'
            )
            ->get();

        return $igm_india_terminals;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igm_india_terminals = DB::table('igm_india_terminals')
            ->select(
                'igm_india_terminals.id',
                'igm_india_terminals.terminal',
                'igm_india_terminals.code',
                'igm_india_terminals.port'
            )
            ->where('igm_india_terminals.id', '=', $id)
            ->get();

        return $igm_india_terminals;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_india_terminals = new igm_india_terminals();
        } else { // update

            $igm_india_terminals = igm_india_terminals::find($id);
        }


        try {
            $igm_india_terminals->terminal = $request->terminal;
            $igm_india_terminals->code = $request->code;
            $igm_india_terminals->port = $request->port;
            $igm_india_terminals->save();


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
