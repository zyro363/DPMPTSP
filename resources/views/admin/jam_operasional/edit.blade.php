@extends('admin.layouts.app', [
'activePage' => 'jam_operasional',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/jam_operasional/update/{{ $item->id }}" method="POST">
         @csrf
         <div class="form-group">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" value="{{ $item->hari }}" required>
         </div>
         <div class="form-group">
            <label>Mulai</label>
            <input type="time" name="mulai" class="form-control" value="{{ $item->mulai }}" required>
         </div>
         <div class="form-group">
            <label>Selesai</label>
            <input type="time" name="selesai" class="form-control" value="{{ $item->selesai }}" required>
         </div>
         <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
               <option value="1" @if($item->status) selected @endif>Aktif</option>
               <option value="0" @if(!$item->status) selected @endif>Nonaktif</option>
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


