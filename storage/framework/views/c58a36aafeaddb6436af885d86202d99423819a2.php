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
                  <li><a href="#settings" data-toggle="tab">THÊM LOẠI SẢN PHẨM</a></li>
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
                     <form class="form-horizontal" method="post" action="<?php echo e(asset('admin/productType/add')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Tên loại sản phẩm</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" name="ten_loai_san_pham" id="loai_san_pham" placeholder="Tên loại sản phẩm" required>
                              
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Loại sản phẩm</label>
                           <div class="col-sm-5">
                              <select name="productType_s" id="productType_s" class="form-control">
                                 <option value="">Chọn loại sản phẩm</option>
                                 <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($prd->id_loai_san_pham); ?>"><?php echo e($prd->loai_san_pham); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                             
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Chủng loại sản phẩm</label>
                           <div class="col-sm-5">
                              <select name="productType_Child" id="productType_Child" class="form-control">
                                 
                              </select>
                           </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Thêm</button>
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
<?php echo $__env->make('block/footer-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;<?php /**PATH C:\xampp\htdocs\vugiaphatpro\resources\views/admin/productType/add.blade.php ENDPATH**/ ?>