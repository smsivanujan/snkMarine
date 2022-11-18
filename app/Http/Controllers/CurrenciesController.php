<?php

namespace App\Http\Controllers;

use App\Models\currencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CurrenciesController extends Controller
{
    public function index()
    {
        $currencies = DB::table('currencies')
            ->select(
                'currencies.id',
                'currencies.currency_code',
                'currencies.currency_name',
                'currencies.country_id',
                'countries.country_name',
                'countries.capital_city_name'
            )
            ->join('countries', 'currencies.country_id', '=', 'countries.id')
            ->paginate(50);

        return $currencies;
    }

    public function showById(Request $request)
    {
        $countryId = $request->countryid;
        $currencies = DB::table('currencies')
            ->select(
                'currencies.id',
                'currencies.currency_code',
                'currencies.currency_name',
                'currencies.country_id',
                'countries.country_name',
                'countries.capital_city_name'
            )
            ->join('countries', 'currencies.country_id', '=', 'countries.id')
            ->where('countries.id', '=', $countryId)
            ->get();

        return $currencies;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'currency_code' => 'unique:currencies,currency_code',
                'currency_name' => 'unique:currencies,currency_name'
            ]);

            $currency = new currencies();
        } else { // update

            $this->validate($request, [
                'country_name' => 'unique:currencies,country_name,' . $id,
                'currency_name' => 'unique:currencies,currency_name,' . $id
            ]);

            $currency = currencies::find($id);
        }

        try {
            $currency->currency_code = $request->currency_code;
            $currency->currency_name = $request->currency_name;
            $currency->country_id = $request->country_id;
            $currency->save();

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
