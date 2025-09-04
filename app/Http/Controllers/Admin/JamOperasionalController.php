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
        // Validasi input berdasarkan status
        $validationRules = [
            'hari' => 'required|string|max:50',
            'status' => 'required|in:0,1',
        ];

        // Jika status buka (1), maka jam mulai dan selesai wajib diisi
        if ($request->status == '1') {
            $validationRules['mulai'] = 'required|date_format:H:i';
            $validationRules['selesai'] = 'required|date_format:H:i|after:mulai';
        }

        $request->validate($validationRules);

        // Siapkan data untuk insert
        $insertData = [
            'hari' => $request->hari,
            'status' => $request->status,
        ];

        // Jika status buka, tambahkan jam mulai dan selesai
        if ($request->status == '1') {
            $insertData['mulai'] = $request->mulai;
            $insertData['selesai'] = $request->selesai;
        } else {
            // Jika status tutup, set jam ke null
            $insertData['mulai'] = null;
            $insertData['selesai'] = null;
        }

        DB::table('jam_operasional')->insert($insertData);

        return redirect('/admin/jam_operasional')->with('success', 'Data Berhasil Ditambah !');
    }

    public function edit($id)
    {
        $item = DB::table('jam_operasional')->where('id', $id)->first();
        
        if (!$item) {
            return redirect('/admin/jam_operasional')->with('error', 'Data tidak ditemukan !');
        }
        
        return view('admin.jam_operasional.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input berdasarkan status
            $validationRules = [
                'hari' => 'required|string|max:50',
                'status' => 'required|in:0,1',
            ];

            // Jika status buka (1), maka jam mulai dan selesai wajib diisi
            if ($request->status == '1') {
                $validationRules['mulai'] = 'required|date_format:H:i';
                $validationRules['selesai'] = 'required|date_format:H:i|after:mulai';
            }

            $request->validate($validationRules);

            // Cek apakah data ada
            $existingData = DB::table('jam_operasional')->where('id', $id)->first();
            if (!$existingData) {
                return redirect('/admin/jam_operasional')->with('error', 'Data tidak ditemukan !');
            }

            // Siapkan data untuk update
            $updateData = [
                'hari' => $request->hari,
                'status' => $request->status,
            ];

            // Jika status buka, tambahkan jam mulai dan selesai
            if ($request->status == '1') {
                $updateData['mulai'] = $request->mulai;
                $updateData['selesai'] = $request->selesai;
            } else {
                // Jika status tutup, set jam ke null atau kosong
                $updateData['mulai'] = null;
                $updateData['selesai'] = null;
            }

            // Update data
            $result = DB::table('jam_operasional')
                ->where('id', $id)
                ->update($updateData);
            
            if ($result) {
                return redirect('/admin/jam_operasional')->with('success', 'Data Berhasil Diupdate !');
            } else {
                return redirect('/admin/jam_operasional')->with('error', 'Tidak ada perubahan data !');
            }
            
        } catch (\Exception $e) {
            return redirect('/admin/jam_operasional')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::table('jam_operasional')->where('id', $id)->delete();
        return redirect('/admin/jam_operasional')->with('success', 'Data Berhasil Dihapus !');
    }
}


