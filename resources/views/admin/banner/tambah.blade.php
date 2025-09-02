@extends('admin.layouts.app', [
'activePage' => 'banner',
])
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>Tambah Banner</h4>
            </div>
         </div>
      </div>
   </div>
   <div class="pd-20 card-box mb-30">
      <form action="/admin/banner/create" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
         </div>
         <div class="text-right">
            <a href="/admin/banner" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
@endsection


