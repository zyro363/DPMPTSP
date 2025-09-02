@extends('admin.layouts.app', [
'activePage' => 'pegawai',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/pegawai/create" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Kontak</label>
            <input type="text" name="contact" class="form-control">
         </div>
         <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
         </div>
         <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
         </div>
         <div class="text-right">
            <a href="/admin/pegawai" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
@endsection


