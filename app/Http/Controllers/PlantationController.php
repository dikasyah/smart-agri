<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Storage;

use App\Models\LocationPlantation;

class PlantationController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

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

        return view('plantation.index');
    }

    public function plantation_save(Request $request)
    {
        LocationPlantation::truncate();
        if ($request->hasFile('plantation')) {
            $fileJSON = $request->file('plantation');

            if($fileJSON->getClientOriginalExtension() == "geojson"){
                $jsonString = file_get_contents($fileJSON);
                $data = json_decode($jsonString, true);

                $coor = '';

                for($a = 0; $a < Count($data['features']); $a++){
                    $location = $data['features'][$a]['properties']['Lokasi'];
                    for($i = 0; $i < Count($data['features'][$a]['geometry']['coordinates'][0][0]); $i++){
                        $x = $data['features'][$a]['geometry']['coordinates'][0][0][$i][1];
                        $y = $data['features'][$a]['geometry']['coordinates'][0][0][$i][0];
                        $coor = $coor.$x.",".$y.",";
                    }
                    $plantation = new LocationPlantation;
                    $plantation->location = $location;
                    $plantation->coordinate = $coor;
                    $plantation->save();

                    $coor = '';
                }

                Session::flash('success', "Location plantation berhasil diupload");
                return redirect('console/plantation');
            }else{
                Session::flash('error', "Data yang diupload tidak sesuai");
                return redirect('console/plantation');
            }
        }else{
            Session::flash('error', "Tidak ada file yang di upload");
            return redirect('console/plantation');
        }
    }
}
