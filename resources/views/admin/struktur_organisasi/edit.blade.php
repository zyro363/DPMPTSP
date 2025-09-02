@extends('admin.layouts.app', [
'activePage' => 'struktur',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/struktur/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            @if($item->foto)
               <div class="mt-2"><img src="{{ asset('storage/'.$item->foto) }}" style="height:60px"></div>
            @endif
         </div>
         <div class="text-right">
            <a href="/admin/struktur" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
@endsection


