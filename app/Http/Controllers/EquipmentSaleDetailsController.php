<?php

namespace App\Http\Controllers;

use App\Models\equipment_sale_details;
use App\Models\equipment_sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EquipmentSaleDetailsController extends Controller
{
    public function index()
    {
        $equipmentsaledetails = DB::table('equipment_sale_details')
            ->select(
                'equipment_sale_details.id',
                'equipment_sale_details.equipment_sale_id',
                'equipment_sale_details.equipment_id',
                'equipment_sale_details.amount',
                'equipment_sale_details.destination',
                'equipment_sales.date',
                'equipment_sales.no_unit',
                'equipment_sales.sale_type',
                'equipments.equipment_number'
            )
            ->join('equipment_sales', 'equipment_sale_details.equipment_sale_id', '=', 'equipment_sales.id')
            ->join('equipments', 'equipment_sale_details.equipment_id', '=', 'equipments.id')
            ->paginate(50);

        return $equipmentsaledetails;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $equipmentsaledetails = DB::table('equipment_sale_details')
            ->select(
                'equipment_sale_details.id',
                'equipment_sale_details.equipment_sale_id',
                'equipment_sale_details.equipment_id',
                'equipment_sale_details.amount',
                'equipment_sale_details.destination',
                'equipment_sales.date',
                'equipment_sales.no_unit',
                'equipment_sales.sale_type',
                'equipments.equipment_number'
            )
            ->join('equipment_sales', 'equipment_sale_details.equipment_sale_id', '=', 'equipment_sales.id')
            ->join('equipments', 'equipment_sale_details.equipment_id', '=', 'equipments.id')
            ->where('equipment_sale_details.equipment_sale_id', '=', $id)
            ->get();

        return $equipmentsaledetails;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $equipmentsaledetail = new equipment_sale_details();
        } else { // update

            $equipmentsaledetail = equipment_sale_details::find($id);
        }


        try {
            $equipmentsaledetail->equipment_sale_id = $request->equipment_sale_id;
            $equipmentsaledetail->equipment_id = $request->equipment_id;
            $equipmentsaledetail->amount = $request->amount;
            $equipmentsaledetail->destination = $request->destination;
            $equipmentsaledetail->save();

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
