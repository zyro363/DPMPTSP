@extends('admin.layouts.app', [
'activePage' => 'jam_operasional',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      @if (session('error'))
      <div class="alert alert-danger">
         {{ session('error')}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success">
         {{ session('success')}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif
      <form action="/admin/jam_operasional/update/{{ $item->id }}" method="POST">
         @csrf
         <div class="form-group">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" value="{{ old('hari', $item->hari) }}" required>
            @error('hari')
                <div class="text-danger">{{ $message }}</div>
            @enderror
         </div>
         <div class="form-group">
            <label>Status</label>
            <select name="status" id="status" class="form-control" required onchange="toggleJamFields()">
               <option value="1" @if(old('status', $item->status) == 1 || old('status', $item->status) == '1') selected @endif>Buka</option>
               <option value="0" @if(old('status', $item->status) == 0 || old('status', $item->status) == '0') selected @endif>Tutup</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
         </div>
         <div class="form-group" id="jam-mulai-group">
            <label>Mulai</label>
            <input type="time" name="mulai" id="mulai" class="form-control" value="{{ old('mulai', $item->mulai) }}" required>
            @error('mulai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
         </div>
         <div class="form-group" id="jam-selesai-group">
            <label>Selesai</label>
            <input type="time" name="selesai" id="selesai" class="form-control" value="{{ old('selesai', $item->selesai) }}" required>
            @error('selesai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
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


