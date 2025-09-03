@extends('admin.layouts.app', [
'activePage' => 'jam_operasional',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      @if ($errors->any())
      <div class="alert alert-danger">
         <strong>Terjadi kesalahan:</strong>
         <ul style="margin-bottom: 0;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <form action="/admin/jam_operasional/create" method="POST">
         @csrf
         <div class="form-group">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" value="{{ old('hari') }}" required>
         </div>
         <div class="form-group">
            <label>Mulai</label>
            <input type="time" name="mulai" class="form-control" value="{{ old('mulai') }}" required>
         </div>
         <div class="form-group">
            <label>Selesai</label>
            <input type="time" name="selesai" class="form-control" value="{{ old('selesai') }}" required>
         </div>
         <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
               <option value="1" @if(old('status', '1')==='1') selected @endif>Buka</option>
               <option value="0" @if(old('status')==='0') selected @endif>Tutup</option>
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


