<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $data = DB::table('banner')->orderBy('id','DESC')->get();
        return view('admin.banner.index', ['data' => $data]);
    }

    public function add()
    {
        return view('admin.banner.tambah');
    }

    public function create(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/banner', $filename, 'public');
        }

        DB::table('banner')->insert([
            'judul' => $request->judul,
            'foto' => $path,
        ]);

        return redirect('/admin/banner')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('banner')->where('id', $id)->first();
        return view('admin.banner.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $update = ['judul' => $request->judul];
        if ($request->hasFile('foto')) {
            $filename = time().'_'.str_replace(' ', '_', $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->storeAs('uploads/banner', $filename, 'public');
            $update['foto'] = $path;
        }

        DB::table('banner')->where('id', $id)->update($update);
        return redirect('/admin/banner')->with('success', 'Data Berhasil Diupdate !');
    }

    public function delete($id)
    {
        DB::table('banner')->where('id', $id)->delete();
        return redirect('/admin/banner')->with('success', 'Data Berhasil Dihapus !');
    }
}


