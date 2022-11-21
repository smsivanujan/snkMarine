<?php

namespace App\Http\Controllers;

use App\Models\soa_subs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SoaSubsController extends Controller
{
    public function index()
    {
        $soasubs = DB::table('soa_subs')
            ->select(
                'soa_subs.id',
                'soa_subs.date',
                'soa_subs.soa_id',
                'soa_subs.client_id_agent',
                'soa_subs.description',
                'soa_subs.income',
                'soa_subs.expenses',
                'soas.date as soasDate',
                'soas.status',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('soas', 'soa_subs.soa_id', '=', 'soas.id')
            ->join('clients', 'soa_subs.client_id_agent', '=', 'clients.id')
            ->paginate(50);

        return $soasubs;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $soasubs = DB::table('soa_subs')
            ->select(
                'soa_subs.id',
                'soa_subs.date',
                'soa_subs.soa_id',
                'soa_subs.client_id_agent',
                'soa_subs.description',
                'soa_subs.income',
                'soa_subs.expenses',
                'soas.date as soasDate',
                'soas.status',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('soas', 'soa_subs.soa_id', '=', 'soas.id')
            ->join('clients', 'soa_subs.client_id_agent', '=', 'clients.id')
            ->where('soas.id', '=', $id)
            ->get();

        return $soasubs;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $soasubs = DB::table('soa_subs')
            ->select(
                'soa_subs.id',
                'soa_subs.date',
                'soa_subs.soa_id',
                'soa_subs.client_id_agent',
                'soa_subs.description',
                'soa_subs.income',
                'soa_subs.expenses',
                'soas.date as soasDate',
                'soas.status',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('soas', 'soa_subs.soa_id', '=', 'soas.id')
            ->join('clients', 'soa_subs.client_id_agent', '=', 'clients.id')
                ->where(function ($q) use ($query) {
                    $q->where('soa_subs.date', 'like', '%' . $query . '%')
                        ->orWhere('soas.status', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_code', 'like', '%' . $query . '%')
                        ->orWhere('clients.client_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $soasubs;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $soasub = new soa_subs();
        } else { // update

            $soasub = soa_subs::find($id);
        }

        try {
            $soasub->date = $request->date;
            $soasub->soa_id = $request->soa_id;
            $soasub->client_id_agent = $request->client_id_agent;
            $soasub->description = $request->description;
            $soasub->income = $request->income;
            $soasub->expenses = $request->expenses;
            $soasub->save();

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
