<?php echo $__env->make('block/dropdown-menu-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
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
                  <a href="<?php echo e(url('/admin/productType/add')); ?>" class="btn btn-success btn-mini">Thêm loại sản phẩm</a><br/>
                  <?php if(Session::has('flash_message_success')): ?>
                  <div class="alert alert-success alert-block">
                     <button type="button" class="close" data-dismiss="alert">x</button>
                     <strong><?php echo session('flash_message_success'); ?></strong>
                  </div>
                  
                  <?php endif; ?>
                 
               </div>
               <!-- /.box-header -->
               <div class="filter-form" style="display:flex">
                  <div class="col-md-2 pl-1">
                     <div class="" id="filter_col1" data-column="1">
                         <label>Loại sản phẩm: </label>
                         <select style="width: 140px; display: inline-block;" name="JobID" class="form-control column_filter_1 input-sm" id="col1_filter">
                                 <option value="">All</option>
                                 <?php $__currentLoopData = $productTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e($data->loai_san_pham); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                         </div>
                   </div>
                   
                   <div class="col-md-2 pl-1">
                     <div class="form-group" id="filter_col2" data-column="2">
                         <label>Chủng loại: </label>
                         <select style="width: 150px; display: inline-block;" name="JobID" class="form-control column_filter_2" id="col2_filter">
                                 <option value="">Tất cả</option>
                                 <?php $__currentLoopData = $productType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e($data->ten_loai_sp_con); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                         </div>
                   </div>
                   
               </div>
               <div class="box-body">
                  
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Loại sản phẩm</th>
                           <th>Chủng loại</th>
                           
                           <th>Chức năng</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $__currentLoopData = $productType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($data->id); ?></td>
                           <td><?php echo e($data->loai_san_pham); ?></td>
                           <td><?php echo e($data->ten_loai_sp_con); ?></td>
                           <td> 
                              <a href="<?php echo e(url('/admin/productType/edit/'.$data->id)); ?>" class="btn btn-primary btn-mini">Sửa</a> 
                              <a href="<?php echo e(url('/admin/productType/delete/'.$data->id)); ?>" class="btn btn-danger btn-mini">Xóa</a> 
                           </td>
                        </tr>
                        <!-- /.modal-dialog -->
               </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
                  <tfoot>
                     <tr>
                        <th>ID</th>
                           <th>Loại sản phẩm</th>
                           <th>Chủng loại</th>
                           
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
<?php echo $__env->make('block/footer-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;<?php /**PATH C:\xampp\htdocs\vugiaphatpro\resources\views/admin/productType/all.blade.php ENDPATH**/ ?>