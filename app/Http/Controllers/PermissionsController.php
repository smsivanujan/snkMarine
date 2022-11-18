<?php

namespace App\Http\Controllers;

use App\Models\permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = DB::table('permissions')
            ->select(
                'permissions.id',
                'permissions.client_id',
                'permissions.permisions',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'permissions.client_id', '=', 'clients.id')
            ->paginate(50);

        return $permissions;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $permissions = DB::table('permissions')
            ->select(
                'permissions.id',
                'permissions.client_id',
                'permissions.permisions',
                'clients.client_code',
                'clients.client_name'
            )
            ->join('clients', 'permissions.client_id', '=', 'clients.id')
            ->where('clients.id', '=', $id)
            ->get();

        return $permissions;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'client_id' => 'required|unique:permissions,client_id'
            ]);

            $permission = new permissions();
        } else { // update


            $this->validate($request, [
                'client_id' => 'required|unique:permissions,client_id,' . $id,
            ]);

            $permission = permissions::find($id);
        }

        try {
            $permission->client_id = $request->client_id;
            $permission->permisions = $request->permisions;
            $permission->save();

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
