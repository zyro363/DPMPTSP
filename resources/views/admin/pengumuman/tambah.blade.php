@extends('admin.layouts.app', [
'activePage' => 'pengumuman',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/pengumuman/create" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
         <label>Tanggal</label>
         <input type="date" name="tanggal" class="form-control">
         </div>
         <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
         </div>
         <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
         </div>
         <div class="text-right">
            <a href="/admin/pengumuman" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
@endsection


