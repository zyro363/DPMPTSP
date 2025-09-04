@extends('admin.layouts.app', [
'activePage' => 'jam_operasional',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <h3 class="text-primary">Detail Jam Operasional</h3>
      <hr>
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label>Hari</label>
               <input type="text" class="form-control" value="{{ $item->hari }}" readonly>
            </div>
            <div class="form-group">
               <label>Status</label>
               <input type="text" class="form-control" value="{{ $item->status ? 'Buka' : 'Tutup' }}" readonly>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label>Mulai</label>
               <input type="text" class="form-control" value="{{ $item->mulai ?? '-' }}" readonly>
            </div>
            <div class="form-group">
               <label>Selesai</label>
               <input type="text" class="form-control" value="{{ $item->selesai ?? '-' }}" readonly>
            </div>
         </div>
      </div>
      <div class="text-right mt-3">
         <a href="/admin/jam_operasional" class="btn btn-secondary">Kembali</a>
         <a href="/admin/jam_operasional/edit/{{ $item->id }}" class="btn btn-primary">Edit</a>
      </div>
   </div>
</div>
@endsection



