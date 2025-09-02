<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VisiMisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('visi_misi')->orderBy('id','DESC')->get();
        return view('admin.visi_misi.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.visi_misi.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        DB::table('visi_misi')->insert([
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);

        return redirect('/admin/visi_misi')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('visi_misi')->where('id', $id)->first();
        return view('admin.visi_misi.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        DB::table('visi_misi')->where('id', $id)->update([
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);
        return redirect('/admin/visi_misi')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('visi_misi')->where('id', $id)->delete();
        return redirect('/admin/visi_misi')->with('success', 'Data Berhasil Dihapus !');
    }
}


