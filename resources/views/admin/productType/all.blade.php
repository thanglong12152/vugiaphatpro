@include('block/dropdown-menu-admin');
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Danh sách sản phẩm
         <small></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#">Tables</a></li>
         <li class="active">Data tables</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
               <div class="box-header">
                  <h3 class="box-title">Danh sách sản phẩm</h3>
                  <a href="{{url('/admin/productType/add')}}" class="btn btn-success btn-mini">Thêm loại sản phẩm</a>
                  @if(Session::has('flash_message_success'))
                  <div class="alert alert-success alert-block">
                     <button type="button" class="close" data-dismiss="alert">x</button>
                     <strong>{!! session('flash_message_success') !!}</strong>
                  </div>
                  @endif
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Tên sản phẩm</th>
                           <th>Loại sản phẩm</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($productType as $data)
                        <tr>
                           <td>{{$data->id_loai_san_pham}}</td>
                           <td>{{$data->loai_san_pham}}</td>
                           <td> 
                              <a href="{{url('/admin/productType/edit/'.$data->id_loai_san_pham)}}" class="btn btn-primary btn-mini">Sửa</a> 
                              <a href="{{url('/admin/productType/delete/'.$data->id_loai_san_pham)}}" class="btn btn-danger btn-mini">Xóa</a> 
                           </td>
                        </tr>
                        <!-- /.modal-dialog -->
               </div>
               @endforeach
               </tbody>
                  <tfoot>
                     <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                     </tr>
                  </tfoot>
               </table>
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
      </div>
      <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('block/footer-admin');