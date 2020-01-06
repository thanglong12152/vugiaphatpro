<?php echo $__env->make('block/dropdown-menu-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
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
                     <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo e(url('admin/product/edit/'.$productDetails->id_san_pham)); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Tên sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" name="name_prod" id="name_prod" value="<?php echo e($productDetails->ten_sp); ?>" placeholder="Tên sản phẩm" required>
                              <span id="checkpass"></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Loại sản phẩm</label>
                           <div class="col-sm-5">
                              <select name="loai_sp" id="loai_sp" class="form-control">
                              <?php $__currentLoopData = $productType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option
                              value="<?php echo e($prd->id_loai_san_pham); ?>"
                              <?php if($prd->id_loai_san_pham === $productDetails->id_loai_san_pham): ?>
                              selected
                              <?php endif; ?> 
                              >
                              <?php echo e($prd->loai_san_pham); ?>

                              </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Chủng loại</label>
                           <div class="col-sm-5">
                              <select name="productType_Child" id="productType_Child" class="form-control">
                              <?php $__currentLoopData = $productType_Child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option
                              value="<?php echo e($prd->id); ?>"
                              <?php if($prd->id === $productDetails->id_loai_sp_con): ?>
                              selected
                              <?php endif; ?> 
                              >
                              <?php echo e($prd->ten_loai_sp_con); ?>

                              </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group tinh_nang">
                           <label for="inputEmail" class="col-sm-2 control-label">Tính năng</label>
                           <div class="col-sm-5">
                              <?php $__currentLoopData = $featureProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <input type="checkbox" name="feature[]" id="tinh_nang" value="<?php echo e($data->id_tinh_nang); ?>" 
                                 <?php $__currentLoopData = $prod_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($prod->id_tinh_nang === $data->id_tinh_nang): ?> 
                                       checked
                                    <?php endif; ?>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 >
                                 
                                 <?php echo e($data->ten_tinh_nang); ?> 
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Mã sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="text" name="ma_sp" class="form-control" id="ma_sp" value="<?php echo e($productDetails->ma_sp); ?>" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Thương hiệu</label>
                           <div class="col-sm-5">
                              <select name="thuong_hieu" id="thuong_hieu" class="form-control">
                              <?php $__currentLoopData = $trademarkAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option
                              value="<?php echo e($prd->id); ?>"
                              <?php if($prd->id === $productDetails->id_thuong_hieu): ?>
                              selected
                              <?php endif; ?> 
                              >
                              <?php echo e($prd->ten_thuong_hieu); ?>

                              </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Kích thước</label>
                           <div class="col-sm-5">
                              <input type="text" name="kich_thuoc" class="form-control" id="kich_thuoc" value="<?php echo e($productDetails->kich_thuoc_sp); ?>" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Chất liệu</label>
                           <div class="col-sm-5">
                              <input type="text" name="chat_lieu" class="form-control" id="chat_lieu" value="<?php echo e($productDetails->chat_lieu); ?>" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Thời gian bảo hành</label>
                           <div class="col-sm-5">
                              <input type="text" name="thoi_gian_bh" class="form-control" id="thoi_gian_bh" value="<?php echo e($productDetails->thoi_gian_bh); ?>" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Chức năng</label>
                           <div class="col-sm-5">
                              <input type="text" name="chuc_nang" class="form-control" id="chuc_nang" value="<?php echo e($productDetails->chuc_nang); ?>" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Phụ kiện đi kèm</label>
                           <div class="col-sm-5">
                              <input type="text" name="phu_kien_di_kem" class="form-control" id="phu_kien_di_kem" value="<?php echo e($productDetails->phu_kien_di_kem); ?>" required>
                           </div>
                        </div>
                        <?php $__currentLoopData = $productType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($prd->id_loai_san_pham === $productDetails->id_loai_san_pham && $prd->loai_san_pham === 'Phòng xông hơi' ): ?>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Công suất máy</label>
                           <div class="col-sm-5">
                           <input type="text" name="cong_suat_may" class="form-control" id="cong_suat_may" value="<?php echo e($prd->cong_suat_may); ?>" placeholder="Công suất máy">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Điện năng</label>
                           <div class="col-sm-5">
                           <input type="text" name="dien_nang" class="form-control" id="dien_nang" value="<?php echo e($prd->dien_nang); ?>" placeholder="Điện năng">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Ống cấp nước</label>
                           <div class="col-sm-5">
                           <input type="text" name="ong_cap_nuoc" class="form-control" id="ong_cap_nuoc" value="<?php echo e($prd->ong_cap_nuoc); ?>" placeholder="Ống cấp nước">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Dây điện</label>
                           <div class="col-sm-5">
                           <input type="text" name="day_dien" class="form-control" id="day_dien" value="<?php echo e($prd->day_dien); ?>" placeholder="Dây điện">
                           </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="form-group mo_ta">
                           <label for="inputEmail" class="col-sm-2 control-label">Mô tả</label>
                           <div class="col-sm-8">
                           <textarea name="mo_ta" class="form-control " id="editor1"><?php echo e($productDetails->mo_ta); ?></textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Ảnh sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="file" name="anh_sp" class="form-control" id="anh_sp"  placeholder="Mã sản phẩm" >
                              <input type="hidden" name="current_image" value="<?php echo e($productDetails->anh_sp); ?>">
                              <img src="<?php echo e(asset('/image/product/small/'.$productDetails->anh_sp)); ?>" alt="">
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
<?php echo $__env->make('block/footer-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;<?php /**PATH C:\xampp\htdocs\vugiaphatpro\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>