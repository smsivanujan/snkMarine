<?php

namespace App\Http\Controllers;

use App\Models\timezones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TimezonesController extends Controller
{
    public function index()
    {
        $timezones = DB::table('timezones')
            ->select(
                'timezones.id',
                'timezones.timezone_data_name',
                'timezones.timezone_data_value'
            )
            ->paginate(50);

        return $timezones;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'timezone_data_name' => 'required|unique:timezones,timezone_data_name'
            ]);

            $timezone = new timezones();
        } else { // update

            $this->validate($request, [
                'timezone_data_name' => 'required|unique:timezones,timezone_data_name,' . $id
            ]);

            $timezone = timezones::find($id);
        }

        try {
            $timezone->timezone_data_name = $request->timezone_data_name;
            $timezone->timezone_data_value = $request->timezone_data_value;
            $timezone->save();

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
