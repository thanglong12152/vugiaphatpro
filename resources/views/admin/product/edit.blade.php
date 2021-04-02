@include('block/dropdown-menu-admin');
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         SỬA SẢN PHẨM
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#">Examples</a></li>
         <li class="active">SỬA SẢN PHẨM</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- /.col -->
         <div class="col-md-12">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li><a href="#settings" data-toggle="tab">SỬA SẢN PHẨM</a></li>
               </ul>
               <div class="tab-content">
                  <!-- /.tab-pane -->
                  @if(Session::has('flash_message_success'))
                  <div class="alert alert-success alert-block">
                     <button type="button" class="close" data-dismiss="alert">x</button>
                     <strong>{!! session('flash_message_success') !!}</strong>
                  </div>
                  @endif
                  @if(Session::has('flash_message_error'))
                  <div class="alert alert-danger alert-block">
                     <button type="button" class="close" data-dismiss="alert">x</button>
                     <strong>{!! session('flash_message_error') !!}</strong>
                  </div>
                  @endif
                  <div class="active tab-pane" id="settings">
                     <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('admin/product/edit/'.$productDetails->id_san_pham)}}">
                        {{csrf_field()}}
                        <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Tên sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="hidden" class="form-control" name="id_sp" id="id_sp" value="{{$productDetails->id_san_pham}}" placeholder="Tên sản phẩm" required>
                              <input type="text" class="form-control" name="name_prod" id="name_prod" value="{{$productDetails->ten_sp}}" placeholder="Tên sản phẩm" required>
                              <span id="checkpass"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Loại sản phẩm</label>
                           <div class="col-sm-5">
                              <select name="loai_sp" id="loai_sp" class="form-control">
                              @foreach($productType as $prd)
                              <option
                              value="{{$prd->id_loai_san_pham}}"
                              @if($prd->id_loai_san_pham === $productDetails->id_loai_san_pham)
                              selected
                              @endif 
                              >
                              {{$prd->loai_san_pham}}
                              </option>
                              @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Chủng loại</label>
                           <div class="col-sm-5">
                              <select name="productType_Child" id="productType_Child" class="form-control">
                              @foreach($productType_Child as $prd)
                              <option
                              value="{{$prd->id}}"
                              @if($prd->id === $productDetails->id_loai_sp_con)
                              selected
                              @endif 
                              >
                              {{$prd->ten_loai_sp_con}}
                              </option>
                              @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="form-group tinh_nang">
                           <label for="inputEmail" class="col-sm-2 control-label">Tính năng</label>
                           <div class="col-sm-5">
                              @php
                              foreach($featureProduct as $prod){
                                 //dd($prod);
                                 $check= " ";
                                    $data = explode(',',$prod_data);
                                    //dd($data);
                                    for($i=0;$i<count(explode(',',$prod_data));$i++){
                                       
                                       if($prod->ten_tinh_nang === $data[$i]){
                                          $check = "checked";
                                       
                                          // echo '<input type="checkbox" name="feature[]" id="tinh_nang" value="'.$data[$i].'" '.$check.'>'.$data[$i].'';
                                       }
                                       
                                    }
                                  echo '<input type="checkbox" name="feature[]" id="tinh_nang" value="'.$prod->id_tinh_nang.'" '.$check.'>'.$prod->ten_tinh_nang.'';
                                 }
                             @endphp
   
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Mã sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="text" name="ma_sp" class="form-control" id="ma_sp" value="{{$productDetails->ma_sp}}" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Thương hiệu</label>
                           <div class="col-sm-5">
                              <select name="thuong_hieu" id="thuong_hieu" class="form-control">
                              @foreach($trademarkAll as $prd)
                              <option
                              value="{{$prd->id}}"
                              @if($prd->id === $productDetails->id_thuong_hieu)
                              selected
                              @endif 
                              >
                              {{$prd->ten_thuong_hieu}}
                              </option>
                              @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Kích thước</label>
                           <div class="col-sm-5">
                              <input type="text" name="kich_thuoc" class="form-control" id="kich_thuoc" value="{{$productDetails->kich_thuoc_sp}}" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Chất liệu</label>
                           <div class="col-sm-5">
                              <input type="text" name="chat_lieu" class="form-control" id="chat_lieu" value="{{$productDetails->chat_lieu}}" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Thời gian bảo hành</label>
                           <div class="col-sm-5">
                              <input type="text" name="thoi_gian_bh" class="form-control" id="thoi_gian_bh" value="{{$productDetails->thoi_gian_bh}}" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Chức năng</label>
                           <div class="col-sm-5">
                              <input type="text" name="chuc_nang" class="form-control" id="chuc_nang" value="{{$productDetails->chuc_nang}}" >
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Phụ kiện đi kèm</label>
                           <div class="col-sm-5">
                              <input type="text" name="phu_kien_di_kem" class="form-control" id="phu_kien_di_kem" value="{{$productDetails->phu_kien_di_kem}}" >
                           </div>
                        </div>
                        @foreach($productType as $prd)
                        @if($prd->id_loai_san_pham === $productDetails->id_loai_san_pham && $prd->loai_san_pham === 'Phòng xông hơi' )
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Công suất máy</label>
                           <div class="col-sm-5">
                           <input type="text" name="cong_suat_may" class="form-control" id="cong_suat_may" value="{{$prd->cong_suat_may}}" placeholder="Công suất máy">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Điện năng</label>
                           <div class="col-sm-5">
                           <input type="text" name="dien_nang" class="form-control" id="dien_nang" value="{{$prd->dien_nang}}" placeholder="Điện năng">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Ống cấp nước</label>
                           <div class="col-sm-5">
                           <input type="text" name="ong_cap_nuoc" class="form-control" id="ong_cap_nuoc" value="{{$prd->ong_cap_nuoc}}" placeholder="Ống cấp nước">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Dây điện</label>
                           <div class="col-sm-5">
                           <input type="text" name="day_dien" class="form-control" id="day_dien" value="{{$prd->day_dien}}" placeholder="Dây điện">
                           </div>
                        </div>
                        @endif
                        @endforeach
                        
                        <div class="form-group mo_ta">
                           <label for="inputEmail" class="col-sm-2 control-label">Mô tả</label>
                           <div class="col-sm-8">
                           <textarea name="mo_ta" class="form-control " id="editor1">{{$productDetails->mo_ta}}</textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Ảnh sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="file" name="anh_sp" class="form-control" id="anh_sp"  placeholder="Mã sản phẩm" >
                              <input type="hidden" name="current_image" value="{{$productDetails->anh_sp}}">
                              <img src="{{asset('/image/product/small/'.$productDetails->anh_sp)}}" alt="">
                           </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Submit</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <!-- /.tab-pane -->
               </div>
               <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('block/footer-admin');