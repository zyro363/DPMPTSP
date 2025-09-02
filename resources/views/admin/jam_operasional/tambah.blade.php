@extends('admin.layouts.app', [
'activePage' => 'jam_operasional',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/jam_operasional/create" method="POST">
         @csrf
         <div class="form-group">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Mulai</label>
            <input type="time" name="mulai" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Selesai</label>
            <input type="time" name="selesai" class="form-control" required>
         </div>
         <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
               <option value="1">Aktif</option>
               <option value="0">Nonaktif</option>
            </select>
         </div>
         <div class="text-right">
            <a href="/admin/jam_operasional" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
@endsection


