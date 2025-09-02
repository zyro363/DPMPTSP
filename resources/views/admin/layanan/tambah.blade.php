@extends('admin.layouts.app', [
'activePage' => 'layanan',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/layanan/create" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
         </div>
         <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
         </div>
         <div class="text-right">
            <a href="/admin/layanan" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
@endsection


