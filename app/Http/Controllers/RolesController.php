<?php

namespace App\Http\Controllers;

use App\Models\roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')
            ->select(
                'roles.id',
                'roles.role_name',
                'roles.description'
            )
            ->paginate(50);

        return $roles;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'role_name' => 'unique:roles,role_name'
            ]);

            $role = new roles();
        } else { // update

            $this->validate($request, [
                'role_name' => 'unique:roles,role_name,' . $id
            ]);

            $role = roles::find($id);
        }

        try {
            $role->role_name = $request->role_name;
            $role->description = $request->description;
            $role->save();

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
