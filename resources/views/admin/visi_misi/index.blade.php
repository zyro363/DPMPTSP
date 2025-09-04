@extends('admin.layouts.app', [
'activePage' => 'visi_misi',
])
@section('content')
<div class="min-height-200px">
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-list"></i> Visi & Misi</h2>
         </div>
         <div class="pull-right">
            <a href="/admin/visi_misi/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
         </div>
      </div>
      <hr>
      <table class="table table-striped table-bordered data-table hover">
         <thead class="bg-primary text-white">
            <tr>
               <th>#</th>
               <th>Visi</th>
               <th>Misi</th>
               <th class="text-center">Action</th>
            </tr>
         </thead>
         <tbody>
            <?php $no = 1; ?>
            @foreach($data as $row)
            <tr>
               <td class="text-center">{{$no++}}</td>
               <td>{!! Str::limit($row->visi, 120) !!}</td>
               <td>{!! Str::limit($row->misi, 120) !!}</td>
               <td class="text-center" width="20%">
                  <a href="/admin/visi_misi/detail/{{$row->id}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                  <a href="/admin/visi_misi/edit/{{$row->id}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                  <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#data-{{$row->id}}"><i class="fa fa-trash"></i></button>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@foreach($data as $row)
<div class="modal fade" id="data-{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h2 class="text-center">Apakah Anda Yakin Menghapus Data Ini ?</h2>
            <hr>
            <div class="row mt-4">
               <div class="col-md-6">
                  <a href="/admin/visi_misi/delete/{{$row->id}}" style="text-decoration: none;">
                  <button type="button" class="btn btn-primary btn-block">Ya</button>
                  </a>
               </div>
               <div class="col-md-6">
                  <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">Tidak</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endforeach
@endsection


