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
               <div class="filter-form" style="display:flex">
                  <div class="col-md-2 pl-1">
                     <div class="form-group" id="filter_col2" data-column="2">
                         <label>Loại sản phẩm: </label>
                         <select style="width: 140px; display: inline-block;" name="JobID" class="form-control column_filter_2" id="col2_filter">
                                 <option value="">Tất cả</option>
                                 @foreach($productType as $data)
                                    <option>{{$data->loai_san_pham}}</option>
                                 @endforeach
                         </select>
                         </div>
                   </div>
                  <div class="col-md-2 pl-1">
                     <div class="form-group" id="filter_col3" data-column="3">
                         <label>Chủng loại: </label>
                         <select style="width: 140px; display: inline-block;" name="chung_loai" class="form-control column_filter_3" id="col3_filter">
                                 <option value="">Tất cả</option>
                                 @foreach($productType_Child as $data)
                                    <option>{{$data->ten_loai_sp_con}}</option>
                                 @endforeach
                         </select>
                         </div>
                   </div>
                   
                   <div class="col-md-2 pl-1">
                     <div class="form-group" id="filter_col4" data-column="4">
                         <label>Thương hiệu: </label>
                         <select style="width: 140px; display: inline-block;" name="thuong_hieu" class="form-control column_filter_4" id="col4_filter">
                                 <option value="">Tất cả</option>
                                 @foreach($trademark as $data)
                                    <option>{{$data->ten_thuong_hieu}}</option>
                                 @endforeach
                         </select>
                         </div>
                   </div>
                   <div class="col-md-2 pl-1">
                     <div class="" id="filter_col5" data-column="5">
                         <label>Kích thước:</label>
                         <select style="width: 150px; display: inline-block;" name="kich_thuoc" class="form-control column_filter_5 input-sm" id="col5_filter">
                                 <option value="">Tất cả</option>
                                 @foreach($size as $data)
                                    <option>{{$data->kich_thuoc}}</option>
                                 @endforeach
                         </select>
                         </div>
                   </div>
               </div>
               <div class="box-body">
                   
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Tên sản phẩm</th>
                           <th>Loại sản phẩm</th>
                           <th>Chủng loại</th>
                           <th>Thương hiệu</th>
                           <th>Kích thước</th>
                           <th>Mã sản phẩm</th>
                           
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
                           <td>{{$data->ten_loai_sp_con}}</td>
                           <td>{{$data->ten_thuong_hieu}}</td>
                           <td>{{$data->kich_thuoc_sp}}</td>
                           <td>{{$data->ma_sp}}</td>
                           
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
                                          <div class="ma-sp"><b class="text-uppercase">Mã sản phẩm:  </b> {{$data->ma_sp}}</div>
                                          <div class="price"><b class="text-uppercase">giá:  </b> <div class="price" style="color:red">{{number_format($data->sale_price,0,".",".")}}₫</div></div>
                                          
                                          <div class="prd-type"><b class="text-uppercase">Loại sản phẩm:  </b><div class="price"> {{$data->ten_loai_sp_con}}</div></div>
                                          <div class="trademark"><b class="text-uppercase">Thương hiệu: </b> <div class="price">{{$data->ten_thuong_hieu}}</div></div>
                                          <div class="size"><b class="text-uppercase">Kích thước:  </b><div class="price"> {{$data->kich_thuoc_sp}}</div></div>
                                          <div class="chat-lieu"><b class="text-uppercase">Chất liệu:  </b><div class="price"> {{$data->chat_lieu}}</div></div>
                                          <div class="xuat-xu"><b class="text-uppercase">Xuất xứ:  </b> <div class="price">{{$data->xuat_xu}}</div></div>
                                          <div class="thiet-ke"><b class="text-uppercase">Thiết kế:  </b> <div class="price">{{$data->thiet_ke}}</div></div>
                                          <div class="thoi-gian-bh"><b class="text-uppercase">Thời gian bảo hành: <div class="price"> </b> {{$data->thoi_gian_bh}}</div></div>
                                          <div class="chuc-nang"><b class="text-uppercase">Chức năng:  </b> <div class="price">{{$data->chuc_nang}}</div></div>
                                          <div class="phu-kien"><b class="text-uppercase">Phụ kiện đi kèm:  </b> <div class="price">{{$data->phu_kien_di_kem}}</div></div>
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
                           <th>Chủng loại</th>
                           <th>Thương hiệu</th>
                           <th>Kích thước</th>
                           <th>Mã sản phẩm</th>
                           
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