<?php

namespace App\Http\Controllers;

use App\Models\igm_lanka_dos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgmLankaDosController extends Controller
{
    public function index()
    {
        $igm_lanka_dos = DB::table('igm_lanka_dos')
            ->select(
                'igm_lanka_dos.id',
                'igm_lanka_dos.bill_of_landing_id',
                'igm_lanka_dos.serial_number',
                'igm_lanka_dos.client_id_forwarding_agent',
                'igm_lanka_dos.client_id_consignee',
                'igm_lanka_dos.do_expire',
                'igm_lanka_dos.igm_india_voyage_id',
                'igm_lanka_dos.date_issue',
                'igm_lanka_dos.vendor_id_warhouse',
                'igm_lanka_dos.port_id_loading',
                'igm_lanka_dos.package_type',
                'igm_lanka_dos.number_pkg',
                'igm_lanka_dos.number_in_word',
                'igm_lanka_dos.twft',
                'igm_lanka_dos.foft',
                'igm_lanka_dos.foft_over',
                'igm_lanka_dos.vendor_id_yard',
                'igm_lanka_dos.deleted',
                'bill_of_landings.bill_of_landing_number',
                'fwagent.client_code',
                'fwagent.client_name',
                'consignee.client_code',
                'consignee.client_name',
                'igm_india_voyages.voyage',
                'warhouse.vendor_code',
                'warhouse.vendor_name',
                'yard.vendor_code',
                'yard.vendor_name',
                'ports.port_code',
                'ports.port_name'
            )
            ->join('bill_of_landings', 'igm_lanka_dos.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as fwagent', 'igm_lanka_dos.client_id_forwarding_agent', '=', 'fwagent.id')
            ->join('clients as consignee', 'igm_lanka_dos.client_id_consignee', '=', 'consignee.id')
            ->join('igm_india_voyages', 'igm_lanka_dos.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('vendors as warhouse', 'igm_lanka_dos.vendor_id_warhouse', '=', 'warhouse.id')
            ->join('ports', 'igm_lanka_dos.port_id_loading', '=', 'ports.id')
            ->join('vendors as yard', 'igm_lanka_dos.vendor_id_yard', '=', 'yard.id')
            ->paginate(50);

        return $igm_lanka_dos;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $igm_lanka_dos = DB::table('igm_lanka_dos')
            ->select(
                'igm_lanka_dos.id',
                'igm_lanka_dos.bill_of_landing_id',
                'igm_lanka_dos.serial_number',
                'igm_lanka_dos.client_id_forwarding_agent',
                'igm_lanka_dos.client_id_consignee',
                'igm_lanka_dos.do_expire',
                'igm_lanka_dos.igm_india_voyage_id',
                'igm_lanka_dos.date_issue',
                'igm_lanka_dos.vendor_id_warhouse',
                'igm_lanka_dos.port_id_loading',
                'igm_lanka_dos.package_type',
                'igm_lanka_dos.number_pkg',
                'igm_lanka_dos.number_in_word',
                'igm_lanka_dos.twft',
                'igm_lanka_dos.foft',
                'igm_lanka_dos.foft_over',
                'igm_lanka_dos.vendor_id_yard',
                'igm_lanka_dos.deleted',
                'bill_of_landings.bill_of_landing_number',
                'fwagent.client_code',
                'fwagent.client_name',
                'consignee.client_code',
                'consignee.client_name',
                'igm_india_voyages.voyage',
                'warhouse.vendor_code',
                'warhouse.vendor_name',
                'yard.vendor_code',
                'yard.vendor_name',
                'ports.port_code',
                'ports.port_name'
            )
            ->join('bill_of_landings', 'igm_lanka_dos.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as fwagent', 'igm_lanka_dos.client_id_forwarding_agent', '=', 'fwagent.id')
            ->join('clients as consignee', 'igm_lanka_dos.client_id_consignee', '=', 'consignee.id')
            ->join('igm_india_voyages', 'igm_lanka_dos.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('vendors as warhouse', 'igm_lanka_dos.vendor_id_warhouse', '=', 'warhouse.id')
            ->join('ports', 'igm_lanka_dos.port_id_loading', '=', 'ports.id')
            ->join('vendors as yard', 'igm_lanka_dos.vendor_id_yard', '=', 'yard.id')
            ->where('igm_lanka_dos.id', '=', $id)
            ->get();

        return $igm_lanka_dos;
    }

    public function showBySearch(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');

            $igm_lanka_dos = DB::table('igm_lanka_dos')
            ->select(
                'igm_lanka_dos.id',
                'igm_lanka_dos.bill_of_landing_id',
                'igm_lanka_dos.serial_number',
                'igm_lanka_dos.client_id_forwarding_agent',
                'igm_lanka_dos.client_id_consignee',
                'igm_lanka_dos.do_expire',
                'igm_lanka_dos.igm_india_voyage_id',
                'igm_lanka_dos.date_issue',
                'igm_lanka_dos.vendor_id_warhouse',
                'igm_lanka_dos.port_id_loading',
                'igm_lanka_dos.package_type',
                'igm_lanka_dos.number_pkg',
                'igm_lanka_dos.number_in_word',
                'igm_lanka_dos.twft',
                'igm_lanka_dos.foft',
                'igm_lanka_dos.foft_over',
                'igm_lanka_dos.vendor_id_yard',
                'igm_lanka_dos.deleted',
                'bill_of_landings.bill_of_landing_number',
                'fwagent.client_code',
                'fwagent.client_name',
                'consignee.client_code',
                'consignee.client_name',
                'igm_india_voyages.voyage',
                'warhouse.vendor_code',
                'warhouse.vendor_name',
                'yard.vendor_code',
                'yard.vendor_name',
                'ports.port_code',
                'ports.port_name'
            )
            ->join('bill_of_landings', 'igm_lanka_dos.bill_of_landing_id', '=', 'bill_of_landings.id')
            ->join('clients as fwagent', 'igm_lanka_dos.client_id_forwarding_agent', '=', 'fwagent.id')
            ->join('clients as consignee', 'igm_lanka_dos.client_id_consignee', '=', 'consignee.id')
            ->join('igm_india_voyages', 'igm_lanka_dos.igm_india_voyage_id', '=', 'igm_india_voyages.id')
            ->join('vendors as warhouse', 'igm_lanka_dos.vendor_id_warhouse', '=', 'warhouse.id')
            ->join('ports', 'igm_lanka_dos.port_id_loading', '=', 'ports.id')
            ->join('vendors as yard', 'igm_lanka_dos.vendor_id_yard', '=', 'yard.id')
            ->where(function ($q) use ($query) {
                $q->where('igm_lanka_dos.serial_number', 'like', '%' . $query . '%')
                    ->orWhere('bill_of_landings.bill_of_landing_number', 'like', '%' . $query . '%')
                    ->orWhere('fwagent.client_code', 'like', '%' . $query . '%')
                    ->orWhere('fwagent.client_name', 'like', '%' . $query . '%')
                    ->orWhere('consignee.client_code', 'like', '%' . $query . '%')
                    ->orWhere('consignee.client_name', 'like', '%' . $query . '%')
                    ->orWhere('igm_india_voyages.voyage', 'like', '%' . $query . '%')
                    ->orWhere('warhouse.vendor_code', 'like', '%' . $query . '%')
                    ->orWhere('warhouse.vendor_name', 'like', '%' . $query . '%')
                    ->orWhere('yard.vendor_code', 'like', '%' . $query . '%')
                    ->orWhere('yard.vendor_name', 'like', '%' . $query . '%')
                    ->orWhere('ports.port_code', 'like', '%' . $query . '%')
                    ->orWhere('ports.port_name', 'like', '%' . $query . '%');
            })
                ->get();
        }

        return $igm_lanka_dos;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $igm_lanka_dos = new igm_lanka_dos();
        } else { // update

            $igm_lanka_dos = igm_lanka_dos::find($id);
        }


        try {
            $igm_lanka_dos->bill_of_landing_id = $request->bill_of_landing_id;
            $igm_lanka_dos->serial_number = $request->serial_number;
            $igm_lanka_dos->client_id_forwarding_agent = $request->client_id_forwarding_agent;
            $igm_lanka_dos->client_id_consignee = $request->client_id_consignee;
            $igm_lanka_dos->do_expire = $request->do_expire;
            $igm_lanka_dos->igm_india_voyage_id = $request->igm_india_voyage_id;
            $igm_lanka_dos->date_issue = $request->date_issue;
            $igm_lanka_dos->vendor_id_warhouse = $request->vendor_id_warhouse;
            $igm_lanka_dos->port_id_loading = $request->port_id_loading;
            $igm_lanka_dos->package_type = $request->package_type;
            $igm_lanka_dos->number_pkg = $request->number_pkg;
            $igm_lanka_dos->number_in_word = $request->number_in_word;
            $igm_lanka_dos->twft = $request->twft;
            $igm_lanka_dos->foft = $request->foft;
            $igm_lanka_dos->foft_over = $request->foft_over;
            $igm_lanka_dos->vendor_id_yard = $request->vendor_id_yard;
            $igm_lanka_dos->deleted = $request->deleted;
            $igm_lanka_dos->save();


            $data = [
                'is_create' => true,
                'error' => []
            ];

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }

    // status change
    public function statusChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $status = 0;//inactive
        } else {
            $status = 1;//active
        }

        $igmlankado = igm_lanka_dos::find($id);
        $igmlankado->deleted = $status;
        $igmlankado->save();

        return 'Done';
    }
}
