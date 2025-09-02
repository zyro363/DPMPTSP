<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JamOperasionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('jam_operasional')->orderBy('id','ASC')->get();
        return view('admin.jam_operasional.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.jam_operasional.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:50',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after:mulai',
            'status' => 'required|boolean',
        ]);

        DB::table('jam_operasional')->insert([
            'hari' => $request->hari,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => $request->status,
        ]);

        return redirect('/admin/jam_operasional')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('jam_operasional')->where('id', $id)->first();
        return view('admin.jam_operasional.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string|max:50',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after:mulai',
            'status' => 'required|boolean',
        ]);

        DB::table('jam_operasional')->where('id', $id)->update([
            'hari' => $request->hari,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => $request->status,
        ]);
        return redirect('/admin/jam_operasional')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('jam_operasional')->where('id', $id)->delete();
        return redirect('/admin/jam_operasional')->with('success', 'Data Berhasil Dihapus !');
    }
}


