@extends('admin.layouts.app', [
'activePage' => 'visi_misi',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <form action="/admin/visi_misi/create" method="POST">
         @csrf
         <div class="form-group">
            <label>Visi</label>
            <textarea name="visi" class="form-control summernote" required></textarea>
         </div>
         <div class="form-group">
            <label>Misi</label>
            <textarea name="misi" class="form-control summernote" required></textarea>
         </div>
         <div class="text-right">
            <a href="/admin/visi_misi" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
  if (typeof $ !== 'undefined' && $.fn.summernote) {
    $('.summernote').summernote({height: 200});
  }
});
</script>
@endsection


