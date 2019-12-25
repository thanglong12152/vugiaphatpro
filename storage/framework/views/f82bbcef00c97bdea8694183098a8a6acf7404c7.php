<?php echo $__env->make('block/dropdown-menu-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
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
                  <?php if(Session::has('flash_message_success')): ?>
                  <div class="alert alert-success alert-block">
                     <button type="button" class="close" data-dismiss="alert">x</button>
                     <strong><?php echo session('flash_message_success'); ?></strong>
                  </div>
                  <?php endif; ?>
                  <?php if(Session::has('flash_message_error')): ?>
                  <div class="alert alert-danger alert-block">
                     <button type="button" class="close" data-dismiss="alert">x</button>
                     <strong><?php echo session('flash_message_error'); ?></strong>
                  </div>
                  <?php endif; ?>
                  <div class="active tab-pane" id="settings">
                     <form enctype="multipart/form-data" class="form-horizontal" method="post" action="<?php echo e(asset('admin/product/add')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group productType">
                           <label for="inputEmail" class="col-sm-2 control-label">Loại sản phẩm</label>
                           <div class="col-sm-5">
                              
                              <select name="productType" id="productType" class="form-control">
                                 <option value="">Chọn loại sản phẩm</option>
                                 <?php $__currentLoopData = $productType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($prd->id_loai_san_pham); ?>"><?php echo e($prd->loai_san_pham); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Chủng loại sản phẩm</label>
                           <div class="col-sm-5">
                              <select name="productType_Child" id="productType_Child" class="form-control">
                                 <option value="">---Vui lòng chọn loại sản phẩm---</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group name_prod">
                           <label for="inputName" class="col-sm-2 control-label">Tên sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" name="name_prod" id="name_prod" placeholder="Tên sản phẩm" required>
                              <span id="checkpass"></span>
                           </div>
                        </div>
                        <div class="form-group ma_sp">
                           <label for="inputEmail" class="col-sm-2 control-label">Mã sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="text" name="ma_sp" class="form-control" id="ma_sp" placeholder="Mã sản phẩm" required>
                           </div>
                        </div>
                        <div class="form-group gia_sp">
                           <label for="inputEmail" class="col-sm-2 control-label">Giá gốc</label>
                           <div class="col-sm-5">
                              <input type="number" name="gia_sp" class="form-control" id="gia_sp" placeholder="Giá sản phẩm" required>
                           </div>
                        </div>
                        <div class="form-group sale_price">
                           <label for="inputEmail" class="col-sm-2 control-label">Giá giảm giá</label>
                           <div class="col-sm-5">
                              <input type="number" name="sale_price" class="form-control" id="sale_price" placeholder="Giá giảm giá" required>
                           </div>
                        </div>
                        
                        <div class="form-group max_people" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Số người sử dụng</label>
                           <div class="col-sm-5">
                              <input type="text" name="max_people" class="form-control" id="max_people" placeholder="Số người sử dụng">
                           </div>
                        </div>
                        <div class="form-group cong_suat_may" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Công suất máy</label>
                           <div class="col-sm-5">
                              <input type="text" name="cong_suat_may" class="form-control" id="cong_suat_may" placeholder="Công suất máy">
                           </div>
                        </div>
                        
                        
                        
                        <div class="form-group dien_nang" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Điện năng</label>
                           <div class="col-sm-5">
                              <input type="text" name="dien_nang" class="form-control" id="dien_nang" placeholder="Chủng loại" >
                           </div>
                        </div>
                        <div class="form-group ong_cap_nuoc" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Ống cấp nước</label>
                           <div class="col-sm-5">
                              <input type="text" name="ong_cap_nuoc" class="form-control" id="ong_cap_nuoc" placeholder="Ống cấp nước" >
                           </div>
                        </div>
                        <div class="form-group day_dien" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Dây điện</label>
                           <div class="col-sm-5">
                              <input type="text" name="day_dien" class="form-control" id="day_dien" placeholder="Dây điện" >
                           </div>
                        </div>
                        
                        
                        <div class="form-group kieu_dang" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Kiểu dáng</label>
                           <div class="col-sm-5">
                              <input type="text" name="kieu_dang" class="form-control" id="kieu_dang" placeholder="Kiểu dáng" >
                           </div>
                        </div>
                        <div class="form-group loai_den" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Loại đèn</label>
                           <div class="col-sm-5">
                              <input type="text" name="loai_den" class="form-control" id="loai_den" placeholder="Loại đèn" >
                           </div>
                        </div>
                        <div class="form-group mau_sac" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Màu sắc</label>
                           <div class="col-sm-5">
                              <input type="text" name="mau_sac" class="form-control" id="mau_sac" placeholder="Màu sắc" >
                           </div>
                        </div>
                        <div class="form-group sai_canh" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Sài cánh</label>
                           <div class="col-sm-5">
                              <input type="text" name="sai_canh" class="form-control" id="sai_canh" placeholder="Sài cánh" >
                           </div>
                        </div>
                        <div class="form-group dong_co" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Động cơ</label>
                           <div class="col-sm-5">
                              <input type="text" name="dong_co" class="form-control" id="dong_co" placeholder="Sài cánh" >
                           </div>
                        </div>
                        <div class="form-group cong_suat_den" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Công suất đèn</label>
                           <div class="col-sm-5">
                              <input type="text" name="cong_suat_den" class="form-control" id="cong_suat_den" placeholder="Công suất đèn" >
                           </div>
                        </div>
                        
                        <div class="form-group kich_thuoc" style="display:none;">
                           <label for="inputEmail"  class="col-sm-2 control-label">Kích thước</label>
                           <div class="col-sm-5">
                              <input type="text" name="kich_thuoc" class="form-control" id="kich_thuoc" placeholder="Kích thước">
                           </div>
                        </div>
                        <div class="form-group thuong_hieu" style="display:none;">
                           <label for="inputEmail" class="col-sm-2 control-label">Thương hiệu</label>
                           <div class="col-sm-5">
                              <select name="thuong_hieu" id="thuong_hieu" class="form-control">
                                 <?php $__currentLoopData = $trademarkAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option
                                    value="<?php echo e($prd->id); ?>"
                                    >
                                    <?php echo e($prd->ten_thuong_hieu); ?>

                                 </option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group chat_lieu" style="display:none;">
                           <label for="inputEmail" class="col-sm-2 control-label">Chất liệu</label>
                           <div class="col-sm-5">
                              <input type="text" name="chat_lieu" class="form-control" id="chat_lieu" placeholder="Chất liệu" required>
                           </div>
                        </div>
                        <div class="form-group xuat_xu" style="display:none;">
                           <label for="inputEmail" class="col-sm-2 control-label">Xuất xứ</label>
                           <div class="col-sm-5">
                              <input type="text" name="xuat_xu" class="form-control" id="xuat_xu" placeholder="Xuất xứ" required>
                           </div>
                        </div>
                        <div class="form-group thiet_ke" style="display:none;">
                           <label for="inputEmail" class="col-sm-2 control-label">Thiết kế</label>
                           <div class="col-sm-5">
                              <input type="text" name="thiet_ke" class="form-control" id="thiet_ke" placeholder="Thiết kế" required>
                           </div>
                        </div>
                        <div class="form-group thoi_gian_bh" style="display:none;">
                           <label for="inputEmail" class="col-sm-2 control-label">Thời gian bảo hành</label>
                           <div class="col-sm-5">
                              <input type="text" name="thoi_gian_bh" class="form-control" id="thoi_gian_bh" placeholder="Thời gian bảo hành" required>
                           </div>
                        </div>
                        <div class="form-group chuc_nang" style="display:none;">
                           <label for="inputEmail" class="col-sm-2 control-label">Chức năng</label>
                           <div class="col-sm-5">
                              <input type="text" name="chuc_nang" class="form-control" id="chuc_nang" placeholder="Chức năng">
                           </div>
                        </div>
                        <div class="form-group phu_kien_di_kem" style="display:none;">
                           <label for="inputEmail" class="col-sm-2 control-label">Phụ kiện đi kèm</label>
                           <div class="col-sm-5">
                              <input type="text" name="phu_kien_di_kem" class="form-control" id="phu_kien_di_kem" placeholder="Phụ kiện đi kèm">
                           </div>
                        </div>
                        <div class="form-group anh_sp">
                           <label for="inputEmail" class="col-sm-2 control-label">Ảnh sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="file" name="anh_sp" class="form-control" id="anh_sp" placeholder="Ảnh sản phẩm" required>
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
<?php echo $__env->make('block/footer-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;<?php /**PATH C:\xampp\htdocs\vugiaphatpro\resources\views/admin/product/add.blade.php ENDPATH**/ ?>