<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('struktur_organisasi')->orderBy('id','DESC')->get();
        return view('admin.struktur_organisasi.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.struktur_organisasi.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/struktur', $filename, 'public');
        }

        DB::table('struktur_organisasi')->insert([
            'foto' => $path,
        ]);

        return redirect('/admin/struktur')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('struktur_organisasi')->where('id', $id)->first();
        return view('admin.struktur_organisasi.edit', ['item' => $item]);
    }

    public function detail($id)
    {
        $item = DB::table('struktur_organisasi')->where('id', $id)->first();
        if (!$item) {
            return redirect('/admin/struktur')->with('error', 'Data tidak ditemukan !');
        }
        return view('admin.struktur_organisasi.detail', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $update = [];
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/struktur', $filename, 'public');
            $update['foto'] = $path;
        }

        if (!empty($update)) {
            DB::table('struktur_organisasi')->where('id', $id)->update($update);
        }
        return redirect('/admin/struktur')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('struktur_organisasi')->where('id', $id)->delete();
        return redirect('/admin/struktur')->with('success', 'Data Berhasil Dihapus !');
    }
}


