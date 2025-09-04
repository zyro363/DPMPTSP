@extends('admin.layouts.app', [
'activePage' => 'visi_misi',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <h3 class="text-primary">Detail Visi & Misi</h3>
      <hr>
      <div class="row">
         <div class="col-md-6">
            <label>Visi</label>
            <div class="form-control" style="height:auto; min-height:150px; white-space:normal">{!! $item->visi !!}</div>
         </div>
         <div class="col-md-6">
            <label>Misi</label>
            <div class="form-control" style="height:auto; min-height:150px; white-space:normal">{!! $item->misi !!}</div>
         </div>
      </div>
      <div class="text-right mt-3">
         <a href="/admin/visi_misi" class="btn btn-secondary">Kembali</a>
         <a href="/admin/visi_misi/edit/{{ $item->id }}" class="btn btn-primary">Edit</a>
      </div>
   </div>
</div>
@endsection



