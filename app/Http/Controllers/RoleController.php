<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\BASE_TABLE;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

    public function messages(){
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter'
        ];
    }

    public function index(){
        echo 
        '<html>
        <head>
        <style>
        .loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("https://i.pinimg.com/originals/e9/29/1e/e9291eaddacd460280a34a151dcc5cc4.gif") 
                        50% 50% no-repeat #0e1e2f;
            background-size: 100px;
        }
        </style>
        </head>
        <body>
        <div class="loader"></div>
        </body>
        </html>';

        $role = Role::all();
        return view('role.index',['role'=>$role]);
    }

    public function add()
    {
        echo 
        '<html>
        <head>
        <style>
        .loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("https://i.pinimg.com/originals/e9/29/1e/e9291eaddacd460280a34a151dcc5cc4.gif") 
                        50% 50% no-repeat #0e1e2f;
            background-size: 100px;
        }
        </style>
        </head>
        <body>
        <div class="loader"></div>
        </body>
        </html>';

        return view('role.add');
    }

    public function add_save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:roles'
        ], $this->messages());

        $role = Role::create(['name' => $request->name]);

        Session::flash('success', "Role berhasil ditambahkan");
        return redirect('console/role');
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();

        Session::flash('success', "Role berhasil dihapus");
        return response()->json("berhasil");
    }

    public function permission($id){
        echo 
        '<html>
        <head>
        <style>
        .loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("https://i.pinimg.com/originals/e9/29/1e/e9291eaddacd460280a34a151dcc5cc4.gif") 
                        50% 50% no-repeat #0e1e2f;
            background-size: 100px;
        }
        </style>
        </head>
        <body>
        <div class="loader"></div>
        </body>
        </html>';

        // app()['cache']->forget('spatie.permission.cache');

        $role = Role::find($id);
        $permission = Permission::all();
        return view('role.permission',['role'=>$role,'permission'=>$permission]);
    }
}
