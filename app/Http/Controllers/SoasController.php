<?php

namespace App\Http\Controllers;

use App\Models\soas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SoasController extends Controller
{
    public function index()
    {
        $soas = DB::table('soas')
            ->select(
                'soas.id',
                'soas.date',
                'soas.client_id_agent',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'soas.client_id_agent', '=', 'clients.id')
            ->get();

        return $soas;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $soas = DB::table('soas')
            ->select(
                'soas.id',
                'soas.date',
                'soas.client_id_agent',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'soas.client_id_agent', '=', 'clients.id')
            ->where('soas.id', '=', $id)
            ->get();

        return $soas;
    }

    public function store(Request $request)
    {
        $id = $request->id;
        
        if ($id == 0) { // create

            $soa = new soas();

        } else { // update

            $soa = soas::find($id);
        }
       

        try {
            $soa->date = $request->date;
            $soa->client_id_agent = $request->client_id_agent;
            $soa->status = $request->status;
            $soa->save();

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
