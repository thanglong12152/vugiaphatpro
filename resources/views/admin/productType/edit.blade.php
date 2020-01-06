@include('block/dropdown-menu-admin');
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         THÊM SẢN PHẨM
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#">Examples</a></li>
         <li class="active">THÊM SẢN PHẨM</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- /.col -->
         <div class="col-md-12">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li><a href="#settings" data-toggle="tab">THÊM SẢN PHẨM</a></li>
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
                     <form class="form-horizontal" method="post" action="{{url('admin/productType/edit/'.$productType->id)}}">
                        {{csrf_field()}}
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Loại sản phẩm</label>
                           <div class="col-sm-5">
                              <select name="loai_sp" id="loai_sp" class="form-control">
                              @foreach($productTypes as $prd)
                              <option
                              value="{{$prd->id_loai_san_pham}}"
                              @if($prd->id_loai_san_pham === $productType->id_loai_san_pham)
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
                           <label for="inputName" class="col-sm-2 control-label">Chủng loại</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" name="productType_Child" id="productType_Child" value="{{$productType->ten_loai_sp_con}}" placeholder="Tên sản phẩm" required>
                              <span id="checkpass"></span>
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