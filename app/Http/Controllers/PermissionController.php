<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\BASE_TABLE;
use App\Models\BASE_SP;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
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

        $permission = Permission::all();
        return view('permission.index',['permission'=>$permission]);
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

        $permission = Permission::all();
        $table = DB::select('SELECT DISTINCT TABLE_CATALOG FROM BASE_TABLE');
        return view('permission.add',['table'=>$table,'permission'=>$permission]);
    }

    public function add_save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:permissions',
            'stored_procedure' => 'required',
            'database_name' => 'required'
        ], $this->messages());

        $permission = Permission::create(['name' => $request->name,'database_name' => $request->database_name,'stored_procedure' => $request->stored_procedure]);

        Session::flash('success', "Permission berhasil ditambahkan");
        return redirect('console/permission');
    }

    public function view($id)
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

        $permission = Permission::find($id);
        config(['database.connections.sqlsrv2' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '10.15.2.134'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', $permission->database_name),
            'username' => env('DB_USERNAME', 'SAPSSIS'),
            'password' => env('DB_PASSWORD', 'k0mp3n1andika'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ]]);

        $data_sp = DB::connection('sqlsrv2')->select($permission->stored_procedure);
        $header = DB::connection('sqlsrv2')->select("sp_describe_first_result_set N'".$permission->stored_procedure."'");
        $jml_header = Count($header);
        return view('permission.view',['permission'=>$permission,'data_sp'=>$data_sp,'header'=>$header,'jml_header'=>$jml_header]);
    }

    public function db_select(Request $request)
    {
        $sp = BASE_SP::where("Source_DB",$request->database_name)->get();
        return response()->json($sp);
    }

    public function preview(Request $request)
    {
        config(['database.connections.sqlsrv2' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '10.15.2.134'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', $request->database_name),
            'username' => env('DB_USERNAME', 'SAPSSIS'),
            'password' => env('DB_PASSWORD', 'k0mp3n1andika'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ]]);

        $data_sp = DB::connection('sqlsrv2')->select($request->store_procedure);
        $header = DB::connection('sqlsrv2')->select("sp_describe_first_result_set N'".$request->store_procedure."'");
        $jml_header = Count($header);
        return response()->json([$jml_header,$header,$data_sp]);
    }

    public function delete($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        Session::flash('success', "Permission berhasil dihapus");
        return response()->json("berhasil");
    }
}
