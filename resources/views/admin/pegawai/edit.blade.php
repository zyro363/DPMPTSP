@extends('admin.layouts.app', [
'activePage' => 'pegawai',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/pegawai/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="{{ $item->nip }}" required>
         </div>
         <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
         </div>
         <div class="form-group">
            <label>Kontak</label>
            <input type="text" name="contact" class="form-control" value="{{ $item->contact }}">
         </div>
         <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $item->alamat }}</textarea>
         </div>
         <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            @if($item->foto)
               <div class="mt-2"><img src="{{ asset('storage/'.$item->foto) }}" style="height:60px"></div>
            @endif
         </div>
         <div class="text-right">
            <a href="/admin/pegawai" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
@endsection


