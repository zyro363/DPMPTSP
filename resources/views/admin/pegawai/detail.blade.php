@extends('admin.layouts.app', [
'activePage' => 'pegawai',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <h3 class="text-primary">Detail Pegawai</h3>
      <hr>
      <div class="row">
         <div class="col-md-8">
            <div class="form-group">
               <label>NIP</label>
               <input type="text" class="form-control" value="{{ $item->nip }}" readonly>
            </div>
            <div class="form-group">
               <label>Nama</label>
               <input type="text" class="form-control" value="{{ $item->nama }}" readonly>
            </div>
            <div class="form-group">
               <label>Kontak</label>
               <input type="text" class="form-control" value="{{ $item->contact ?? '-' }}" readonly>
            </div>
            <div class="form-group">
               <label>Alamat</label>
               <div class="form-control" style="height:auto; min-height:100px; white-space:normal">{{ $item->alamat ?? '-' }}</div>
            </div>
         </div>
         <div class="col-md-4">
            <label>Foto</label>
            <div>
               @if($item->foto)
                  <img src="{{ asset('storage/'.$item->foto) }}" style="max-height:220px"/>
               @else
                  <span>Tidak ada foto</span>
               @endif
            </div>
         </div>
      </div>
      <div class="text-right mt-3">
         <a href="/admin/pegawai" class="btn btn-secondary">Kembali</a>
         <a href="/admin/pegawai/edit/{{ $item->id }}" class="btn btn-primary">Edit</a>
      </div>
   </div>
</div>
@endsection



