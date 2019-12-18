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
                  <a href="{{url('/admin/product/add')}}" class="btn btn-success btn-mini">Thêm sản phẩm</a>
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
                           <th>Thương hiệu</th>
                           <th>Mã sản phẩm</th>
                           <th>Kích thước</th>
                           <th>Ảnh sản phẩm</th>
                           <th>Chức năng</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($product as $data)
                        <tr>
                           <td>{{$data->id_san_pham}}</td>
                           <td>{{$data->ten_sp}}</td>
                           <td>{{$data->loai_san_pham}}</td>
                           <td>{{$data->ten_thuong_hieu}}</td>
                           <td>{{$data->ma_sp}}</td>
                           <td>{{$data->kich_thuoc_sp}}</td>
                           <td><img src="{{asset('/image/product/small/'.$data->anh_sp)}}" alt="" width="60px"></td>
                           <td> 
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default{{$data->id_san_pham}}">
                              Xem
                              </button>
                              <a href="{{url('/admin/product/edit/'.$data->id_san_pham)}}" class="btn btn-primary btn-mini">Sửa</a> 
                              <a rel="{{$data->id_san_pham}}" rel1="delete" href="javascript:" class="btn btn-danger btn-mini deleteProduct">Xóa</a> 
                           </td>
                        </tr>
                        <div class="modal fade" id="modal-default{{$data->id_san_pham}}">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">THÔNG TIN SẢN PHẨM</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="image-prd col-md-7"><img src="{{asset('/image/product/small/'.$data->anh_sp)}}" alt=""></div>
                                       <div class="profile-prd col-md-5">
                                          <div class="title">
                                             <h4 style="font-weight:bold">{{$data->ten_sp}}</h4>
                                          </div>
                                          <div class="ma-sp">Mã sản phẩm: {{$data->ma_sp}}</div>
                                          <div class="price">Giá: </div>
                                          <div class="name">Tên sản phẩm: {{$data->ten_sp}}</div>
                                          <div class="prd-type">Loại sản phẩm: {{$data->loai_san_pham}}</div>
                                          <div class="trademark">Thương hiệu: {{$data->ten_thuong_hieu}}</div>
                                          <div class="size">Kích thước: </div>
                                          <div class="chat-lieu">Chất liệu: </div>
                                          <div class="xuat-xu">Xuất xứ: </div>
                                          <div class="thiet-ke">Thiết kế: </div>
                                          <div class="thoi-gian-bh">Thời gian bảo hành: </div>
                                          <div class="chuc-nang">Chức năng: </div>
                                          <div class="phu-kien">Phụ kiện đi kèm: </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <a href="{{url('/admin/product/edit/'.$data->id_san_pham)}}" class="btn btn-primary btn-mini">Sửa</a>
                                 </div>
                              </div>
                              <!-- /.modal-content -->
                           </div>
                           <!-- /.modal-dialog -->
                        </div>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>ID</th>
                           <th>Tên sản phẩm</th>
                           <th>Loại sản phẩm</th>
                           <th>Thương hiệu</th>
                           <th>Mã sản phẩm</th>
                           <th>Kích thước</th>
                           <th>Ảnh sản phẩm</th>
                           <th>Chức năng</th>
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