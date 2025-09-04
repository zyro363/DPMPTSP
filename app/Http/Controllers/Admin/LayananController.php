<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('layanan')->orderBy('id','DESC')->get();
        return view('admin.layanan.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.layanan.tambah');
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
            $path = $request->file('foto')->storeAs('uploads/layanan', $filename, 'public');
        }

        DB::table('layanan')->insert([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'foto' => $path,
        ]);

        return redirect('/admin/layanan')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('layanan')->where('id', $id)->first();
        return view('admin.layanan.edit', ['item' => $item]);
    }

    public function detail($id)
    {
        $item = DB::table('layanan')->where('id', $id)->first();
        if (!$item) {
            return redirect('/admin/layanan')->with('error', 'Data tidak ditemukan !');
        }
        return view('admin.layanan.detail', ['item' => $item]);
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
            $path = $request->file('foto')->storeAs('uploads/layanan', $filename, 'public');
            $update['foto'] = $path;
        }

        DB::table('layanan')->where('id', $id)->update($update);
        return redirect('/admin/layanan')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('layanan')->where('id', $id)->delete();
        return redirect('/admin/layanan')->with('success', 'Data Berhasil Dihapus !');
    }
}


