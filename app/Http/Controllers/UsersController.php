<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->select(
                'users.id',
                'users.client_id',
                'users.full_name',
                'users.user_name',
                'users.email',
                'users.user_group',
                'users.own_bc',
                'users.password',
                'users.timezone_id',
                'users.is_active',
                'users.last_login',
                'users.last_logout',
                'users.is_online',
                'users.is_delete',
                'clients.client_code',
                'clients.client_name',
                'timezones.timezone_data_name',
                'timezones.timezone_data_value'
            )
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->join('timezones', 'users.timezone_id', '=', 'timezones.id')
            ->paginate(50);

        return $users;
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $users = DB::table('users')
            ->select(
                'users.id',
                'users.client_id',
                'users.full_name',
                'users.user_name',
                'users.email',
                'users.user_group',
                'users.own_bc',
                'users.password',
                'users.timezone_id',
                'users.is_active',
                'users.last_login',
                'users.last_logout',
                'users.is_online',
                'users.is_delete',
                'clients.client_code',
                'clients.client_name',
                'timezones.timezone_data_name',
                'timezones.timezone_data_value'
            )
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->join('timezones', 'users.timezone_id', '=', 'timezones.id')
            ->where('users.id', '=', $id)
            ->get();

        return $users;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            if ($request['email'] == null) {
                $this->validate($request, [
                    'client_id' => 'required|unique:users,client_id',
                ]);
            } else {
                $this->validate($request, [
                    'email' => 'unique:users,email',
                    'client_id' => 'required|unique:users,client_id',
                ]);
            }

            $user = new users();
        } else { // update

            if ($request['email'] == null) {
                $this->validate($request, [
                    'client_id' => 'required|unique:users,client_id,' . $id,
                ]);
            } else {
                $this->validate($request, [
                    'email' => 'unique:users,email,' . $id,
                    'client_id' => 'required|unique:users,client_id,' . $id,
                ]);
            }

            $user = users::find($id);
        }

        try {
            $user->client_id = $request->client_id;
            $user->full_name = $request->full_name;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->user_group = $request->user_group;
            $user->own_bc = $request->own_bc;
            $user->password = $request->password;
            $user->timezone_id = $request->timezone_id;
            $user->is_active = $request->is_active;
            $user->last_login = $request->last_login;
            $user->last_logout = $request->last_logout;
            $user->is_online = $request->is_online;
            $user->is_delete = $request->is_delete;
            $user->save();

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

        $user = users::find($id);
        $user->is_delete = $status;
        $user->save();

        return 'Done';
    }

    // status change
    public function statusOnlineChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $status = 0;//offline
        } else {
            $status = 1;//online
        }

        $user = users::find($id);
        $user->is_online = $status;
        $user->save();

        return 'Done';
    }
}
