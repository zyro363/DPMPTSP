<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class beritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('berita')->orderBy('id','DESC')->get();
        return view('admin.berita.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.berita.tambah');
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
            $path = $request->file('foto')->storeAs('uploads/berita', $filename, 'public');
        }

        DB::table('berita')->insert([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'tanggal' => $request->tanggal ?? date('Y-m-d'),
        ]);

        return redirect('/admin/berita')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('berita')->where('id', $id)->first();
        return view('admin.berita.edit', ['item' => $item]);
    }

    public function detail($id)
    {
        $item = DB::table('berita')->where('id', $id)->first();
        if (!$item) {
            return redirect('/admin/berita')->with('error', 'Data tidak ditemukan !');
        }
        return view('admin.berita.detail', ['item' => $item]);
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
            $path = $request->file('foto')->storeAs('uploads/berita', $filename, 'public');
            $update['foto'] = $path;
        }

        DB::table('berita')->where('id', $id)->update($update);
        return redirect('/admin/berita')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('berita')->where('id', $id)->delete();
        return redirect('/admin/berita')->with('success', 'Data Berhasil Dihapus !');
    }
}


