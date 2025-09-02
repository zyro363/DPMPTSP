<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InformasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('informasi')->orderBy('id','DESC')->get();
        return view('admin.informasi.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.informasi.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/informasi', $filename, 'public');
        }

        DB::table('informasi')->insert([
            'keterangan' => $request->keterangan,
            'foto' => $path,
        ]);

        return redirect('/admin/informasi')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('informasi')->where('id', $id)->first();
        return view('admin.informasi.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $update = [ 'keterangan' => $request->keterangan ];
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/informasi', $filename, 'public');
            $update['foto'] = $path;
        }

        DB::table('informasi')->where('id', $id)->update($update);
        return redirect('/admin/informasi')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('informasi')->where('id', $id)->delete();
        return redirect('/admin/informasi')->with('success', 'Data Berhasil Dihapus !');
    }
}


