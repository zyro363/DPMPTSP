@extends('admin.layouts.app', [
'activePage' => 'layanan',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <h3 class="text-primary">Detail Layanan</h3>
      <hr>
      <div class="row">
         <div class="col-md-8">
            <div class="form-group">
               <label>Judul</label>
               <input type="text" class="form-control" value="{{ $item->judul }}" readonly>
            </div>
            <div class="form-group">
               <label>Keterangan</label>
               <div class="form-control" style="height:auto; min-height:120px; white-space:normal">{!! $item->keterangan !!}</div>
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
         <a href="/admin/layanan" class="btn btn-secondary">Kembali</a>
         <a href="/admin/layanan/edit/{{ $item->id }}" class="btn btn-primary">Edit</a>
      </div>
   </div>
</div>
@endsection



