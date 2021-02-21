<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
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

        $database = DB::table('sys.databases')->whereNotIn('name', ['master', 'tempdb', 'model', 'msdb', 'SSISDB'])->get();

        return view('report.index',['database'=>$database]);
    }

    public function selectdb($db){
        config(['database.connections.sqlsrv2' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '10.15.2.134'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', $db),
            'username' => env('DB_USERNAME', 'SAPSSIS'),
            'password' => env('DB_PASSWORD', 'k0mp3n1andika'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ]]);

        $table = DB::connection('sqlsrv2')->table('information_schema.tables')->get();
        return response()->json($table);
    }

    public function selecttable($db){
        config(['database.connections.sqlsrv2' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '10.15.2.134'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', $db),
            'username' => env('DB_USERNAME', 'SAPSSIS'),
            'password' => env('DB_PASSWORD', 'k0mp3n1andika'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ]]);

        $table = DB::connection('sqlsrv2')->table('information_schema.tables')->get();
        return response()->json($table);
    }
}
