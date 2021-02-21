<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Tanaman;

class TanamanController extends Controller
{
    public function messages(){
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
        ];
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

        $tanaman = Tanaman::all();
        $length_data = count($tanaman);
        for($i=0;$i<=$length_data-1;$i++){
            $tanaman[$i]->nama = base64_decode($tanaman[$i]->nama);
        }

        return view('tanaman.index',['tanaman'=>$tanaman]);
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

        return view('tanaman.add');
    }

    public function add_save(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
        ], $this->messages());

        $checktanaman = Tanaman::where("nama", base64_encode($request->nama))->first();
        if($checktanaman){
            Session::flash('error', "Nama sudah terdaftar");
            return redirect()->back();
        }

        $tanaman = new Tanaman;
        $tanaman->nama = base64_encode($request->nama);
        $tanaman->save();

        Session::flash('success', "Tanaman berhasil ditambahkan");
        return redirect('console/tanaman');
    }

    public function detail($id)
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

        $tanaman = Tanaman::find($id);
        $tanaman->nama = base64_decode($tanaman->nama);
        return view('tanaman.detail',['tanaman'=>$tanaman]);
    }

    public function detail_save(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
        ], $this->messages());

        $tanaman = Tanaman::find($id);

        $checktanaman = Tanaman::where("nama", base64_encode($request->nama))->first();
        if($checktanaman && $checktanaman->nama != $tanaman->nama){
            Session::flash('error', "Nama sudah terdaftar");
            return redirect()->back();
        }

        $tanaman->nama = base64_encode($request->nama);
        $tanaman->save();

        Session::flash('success', "Data tanaman berhasil diubah");
        return redirect('console/tanaman');
    }

    public function delete($id)
    {
        $tanaman = Tanaman::find($id);
        $tanaman->delete();

        Session::flash('success', "Tanaman berhasil dihapus");
        return response()->json("berhasil");
    }
}
