<?php

namespace App\Http\Controllers;

use App\Models\countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = DB::table('countries')
            ->select(
                'countries.id',
                'countries.country_name',
                'countries.capital_city_name'
            )
            ->paginate(50);

        return $countries;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $countries = DB::table('countries')
            ->select(
                'countries.id',
                'countries.country_name',
                'countries.capital_city_name'
            )
                ->where(function ($q) use ($query) {
                    $q->where('countries.country_name', 'like', '%' . $query . '%')
                    ->orWhere('countries.capital_city_name', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return $countries;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'country_name' => 'unique:countries,country_name',
                'capital_city_name' => 'unique:countries,capital_city_name'
            ]);

            $country = new countries();
        } else { // update

            $this->validate($request, [
                'country_name' => 'unique:countries,country_name,' . $id,
                'capital_city_name' => 'unique:countries,capital_city_name,' . $id
            ]);

            $country = countries::find($id);
        }

        try {
            $country->country_name = $request->country_name;
            $country->capital_city_name = $request->capital_city_name;
            $country->save();

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
