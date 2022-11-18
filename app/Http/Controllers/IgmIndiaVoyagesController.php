<?php

namespace App\Http\Controllers;

use App\Models\igm_india_voyages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmIndiaVoyagesController extends Controller
{
    public function index()
    {
        $igmindiavoyages = DB::table('igm_india_voyages')
            ->select(
                'igm_india_voyages.id',
                'igm_india_voyages.voyage',
                'igm_india_voyages.imo',
                'igm_india_voyages.sign'
            )
            ->paginate(50);

        return $igmindiavoyages;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igmindiavoyages = DB::table('igm_india_voyages')
            ->select(
                'igm_india_voyages.id',
                'igm_india_voyages.voyage',
                'igm_india_voyages.imo',
                'igm_india_voyages.sign'
            )
            ->where('igm_india_voyages.id', '=', $id)
            ->get();

        return $igmindiavoyages;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'voyage' => 'required|unique:igm_india_voyages,voyage'
            ]);

            $igmindiavoyage = new igm_india_voyages();
        } else { // update

            $this->validate($request, [
                'voyage' => 'required|unique:igm_india_voyages,voyage,' . $id
            ]);

            $igmindiavoyage = igm_india_voyages::find($id);
        }

        try {

            $igmindiavoyage->voyage = $request->voyage;
            $igmindiavoyage->imo = $request->imo;
            $igmindiavoyage->sign = $request->sign;
            $igmindiavoyage->save();

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
