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
            <label>Status</label>
            <select name="status" id="status" class="form-control" required onchange="toggleJamFields()">
               <option value="1" @if(old('status', '1')==='1') selected @endif>Buka</option>
               <option value="0" @if(old('status')==='0') selected @endif>Tutup</option>
            </select>
         </div>
         <div class="form-group" id="jam-mulai-group">
            <label>Mulai</label>
            <input type="time" name="mulai" id="mulai" class="form-control" value="{{ old('mulai') }}" required>
         </div>
         <div class="form-group" id="jam-selesai-group">
            <label>Selesai</label>
            <input type="time" name="selesai" id="selesai" class="form-control" value="{{ old('selesai') }}" required>
         </div>
         <div class="text-right">
            <a href="/admin/jam_operasional" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
         </div>
      </form>
   </div>
</div>

<script>
function toggleJamFields() {
    var status = document.getElementById('status').value;
    var jamMulaiGroup = document.getElementById('jam-mulai-group');
    var jamSelesaiGroup = document.getElementById('jam-selesai-group');
    var mulaiInput = document.getElementById('mulai');
    var selesaiInput = document.getElementById('selesai');
    
    if (status == '0') {
        // Status Tutup - sembunyikan field jam
        jamMulaiGroup.style.display = 'none';
        jamSelesaiGroup.style.display = 'none';
        mulaiInput.removeAttribute('required');
        selesaiInput.removeAttribute('required');
        mulaiInput.value = '';
        selesaiInput.value = '';
    } else {
        // Status Buka - tampilkan field jam
        jamMulaiGroup.style.display = 'block';
        jamSelesaiGroup.style.display = 'block';
        mulaiInput.setAttribute('required', 'required');
        selesaiInput.setAttribute('required', 'required');
    }
}

// Jalankan fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    toggleJamFields();
});
</script>
@endsection


