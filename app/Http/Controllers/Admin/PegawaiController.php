<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('pegawai')->orderBy('id','DESC')->get();
        return view('admin.pegawai.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.pegawai.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:50|unique:pegawai,nip',
            'nama' => 'required|string|max:150',
            'contact' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/pegawai', $filename, 'public');
        }

        DB::table('pegawai')->insert([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'contact' => $request->contact,
            'alamat' => $request->alamat,
            'foto' => $path,
        ]);

        return redirect('/admin/pegawai')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('pegawai')->where('id', $id)->first();
        return view('admin.pegawai.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|string|max:50|unique:pegawai,nip,'.$id,
            'nama' => 'required|string|max:150',
            'contact' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $update = [
            'nip' => $request->nip,
            'nama' => $request->nama,
            'contact' => $request->contact,
            'alamat' => $request->alamat,
        ];
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/pegawai', $filename, 'public');
            $update['foto'] = $path;
        }

        DB::table('pegawai')->where('id', $id)->update($update);
        return redirect('/admin/pegawai')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('pegawai')->where('id', $id)->delete();
        return redirect('/admin/pegawai')->with('success', 'Data Berhasil Dihapus !');
    }
}


