<?php echo $__env->make('block/dropdown-menu-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  User Profile
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Examples</a></li>
                  <li class="active">User profile</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-md-3">
                     <!-- Profile Image -->
                     <div class="box box-primary">
                        <div class="box-body box-profile">
                           <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                           <h3 class="profile-username text-center">Nina Mcintire</h3>
                           <p class="text-muted text-center">Software Engineer</p>
                           <ul class="list-group list-group-unbordered">
                              <li class="list-group-item">
                                 <b>Followers</b> <a class="pull-right">1,322</a>
                              </li>
                              <li class="list-group-item">
                                 <b>Following</b> <a class="pull-right">543</a>
                              </li>
                              <li class="list-group-item">
                                 <b>Friends</b> <a class="pull-right">13,287</a>
                              </li>
                           </ul>
                           <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.box-body -->
                     </div>
                     <!-- /.box -->
                     <!-- About Me Box -->
                     <div class="box box-primary">
                        <div class="box-header with-border">
                           <h3 class="box-title">About Me</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                           <p class="text-muted">
                              B.S. in Computer Science from the University of Tennessee at Knoxville
                           </p>
                           <hr>
                           <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                           <p class="text-muted">Malibu, California</p>
                           <hr>
                           <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                           <p>
                              <span class="label label-danger">UI Design</span>
                              <span class="label label-success">Coding</span>
                              <span class="label label-info">Javascript</span>
                              <span class="label label-warning">PHP</span>
                              <span class="label label-primary">Node.js</span>
                           </p>
                           <hr>
                           <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                        </div>
                        <!-- /.box-body -->
                     </div>
                     <!-- /.box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-9">
                     <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                           <li><a href="#settings" data-toggle="tab">Thay đổi mật khẩu</a></li>
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
                              <form class="form-horizontal" method="post" action="<?php echo e(asset('admin/update-pwd')); ?>">
                                 <?php echo e(csrf_field()); ?>

                                 <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Mật khẩu hiện tại</label>
                                    <div class="col-sm-5">
                                       <input type="password" class="form-control" name="current_pwd" id="inputCurrentPassword" placeholder="Mật khẩu hiện tại" required>
                                       <span id="checkpass"></span>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Mật khẩu mới</label>
                                    <div class="col-sm-5">
                                       <input type="password" name="new_pwd" class="form-control" id="inputNewPassword" placeholder="Mật khẩu mới" required>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Nhập lại mật khẩu</label>
                                    <div class="col-sm-5">
                                       <input type="password" name="confirm_pwd" class="form-control" id="inputConfirmPassword" placeholder="Nhập lại mật khẩu" required> 
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
         <?php echo $__env->make('block/footer-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;<?php /**PATH C:\xampp\htdocs\vugiaphatpro\resources\views/admin/settings.blade.php ENDPATH**/ ?>