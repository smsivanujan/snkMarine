<?php

namespace App\Http\Controllers;

use App\Models\swap_histories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SwapHistoriesController extends Controller
{
    public function index()
    {
        $swaphistories = DB::table('swap_histories')
            ->select(
                'swap_histories.id',
                'swap_histories.swap_id',
                'swap_histories.status',
                'swap_histories.equipment_id',
                'swap_histories.client_id_agent',
                'equipments.equipment_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('equipments', 'swap_histories.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swap_histories.client_id_agent', '=', 'clients.id')
            ->paginate(50);

        return $swaphistories;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $swaphistories = DB::table('swap_histories')
            ->select(
                'swap_histories.id',
                'swap_histories.swap_id',
                'swap_histories.status',
                'swap_histories.equipment_id',
                'swap_histories.client_id_agent',
                'equipments.equipment_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('equipments', 'swap_histories.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swap_histories.client_id_agent', '=', 'clients.id')
            ->where('clients.id', '=', $id)
            ->get();

        return $swaphistories;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $swaphistories = DB::table('swap_histories')
            ->select(
                'swap_histories.id',
                'swap_histories.swap_id',
                'swap_histories.status',
                'swap_histories.equipment_id',
                'swap_histories.client_id_agent',
                'equipments.equipment_number',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('equipments', 'swap_histories.equipment_id', '=', 'equipments.id')
            ->join('clients', 'swap_histories.client_id_agent', '=', 'clients.id')
                ->where(function ($q) use ($query) {
                    $q->where('swap_histories.status', 'like', '%' . $query . '%')
                        ->orWhere('equipments.equipment_number', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $swaphistories;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $swaphistorie = new swap_histories();
        } else { // update

            $swaphistorie = swap_histories::find($id);
        }


        try {
            $swaphistorie->swap_id = $request->swap_id;
            $swaphistorie->status = $request->status;
            $swaphistorie->equipment_id = $request->equipment_id;
            $swaphistorie->client_id_agent = $request->client_id_agent;
            $swaphistorie->save();

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
