<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class pengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('pengumuman')->orderBy('id','DESC')->get();
        return view('admin.pengumuman.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.pengumuman.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/pengumuman', $filename, 'public');
        }

        DB::table('pengumuman')->insert([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'tanggal' => $request->tanggal ?? date('Y-m-d'),
        ]);

        return redirect('/admin/pengumuman')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('pengumuman')->where('id', $id)->first();
        return view('admin.pengumuman.edit', ['item' => $item]);
    }

    public function detail($id)
    {
        $item = DB::table('pengumuman')->where('id', $id)->first();
        if (!$item) {
            return redirect('/admin/pengumuman')->with('error', 'Data tidak ditemukan !');
        }
        return view('admin.pengumuman.detail', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $update = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ];
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/pengumuman', $filename, 'public');
            $update['foto'] = $path;
        }

        DB::table('pengumuman')->where('id', $id)->update($update);
        return redirect('/admin/pengumuman')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('pengumuman')->where('id', $id)->delete();
        return redirect('/admin/pengumuman')->with('success', 'Data Berhasil Dihapus !');
    }
}


