<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InovasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('inovasi')->orderBy('id','DESC')->get();
        return view('admin.inovasi.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.inovasi.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/inovasi', $filename, 'public');
        }

        DB::table('inovasi')->insert([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'foto' => $path,
        ]);

        return redirect('/admin/inovasi')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('inovasi')->where('id', $id)->first();
        return view('admin.inovasi.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $update = [
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
        ];
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/inovasi', $filename, 'public');
            $update['foto'] = $path;
        }

        DB::table('inovasi')->where('id', $id)->update($update);
        return redirect('/admin/inovasi')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('inovasi')->where('id', $id)->delete();
        return redirect('/admin/inovasi')->with('success', 'Data Berhasil Dihapus !');
    }
}


