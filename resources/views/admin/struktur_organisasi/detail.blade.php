@extends('admin.layouts.app', [
'activePage' => 'struktur',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <h3 class="text-primary">Detail Struktur Organisasi</h3>
      <hr>
      <div>
         @if($item->foto)
            <img src="{{ asset('storage/'.$item->foto) }}" style="max-height:500px"/>
         @else
            <span>Tidak ada foto</span>
         @endif
      </div>
      <div class="text-right mt-3">
         <a href="/admin/struktur" class="btn btn-secondary">Kembali</a>
         <a href="/admin/struktur/edit/{{ $item->id }}" class="btn btn-primary">Edit</a>
      </div>
   </div>
</div>
@endsection



