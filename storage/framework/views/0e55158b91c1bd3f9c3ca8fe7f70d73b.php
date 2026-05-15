
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('menumanage::menuManage.manage_position'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('Modules/MenuManage/Resources/assets/css/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('Modules/MenuManage/Resources/assets/css/icon-picker.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="role_permission_wrap">
        <div class="permission_title d-flex flex-wrap justify-content-between gap-20 mt-3 mt-sm-0">
            <h4><?php echo e(trans('menumanage::menuManage.menu_manage')); ?></h4>
            <div class="">
                <a href="<?php echo e(route('menumanage.resetSidebar',['role_name' => $role_name ])); ?>"
                   class="primary-btn radius_30px  fix-gr-bg"><?php echo e(__('menumanage::menuManage.Reset to  with Section')); ?></a>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb_20">
            <div class="white-box available_box  student-details ">
                <div class="add-visitor">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="role-selection p-2">
                                <label class="primary_input_label"    for="role_id">Role Name </label>
                                    <select name="role_name" class="primary_select" id="role_id" >
                                        <option <?php echo e($role_name == 'staff' ? 'selected':''); ?> value="staff">Staff</option>
                                        <option <?php echo e($role_name == 'student' ? 'selected':''); ?> value="student">Student</option>
                                        <option <?php echo e($role_name == 'parent' ? 'selected':''); ?> value="parent">Parent</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div id="accordion">
                        <div class="card">
                            
                            <div class="card-header pt-0 pb-0" id="headingOne">
                                <h5 class="mb-0 create-title" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="false" aria-controls="collapseOne">
                                    <button class="btn btn-link add_btn_link">
                                        <?php echo e(__('menumanage::menuManage.Add Section')); ?>

                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse <?php echo e(isset($editPermissionSection) ? 'show':''); ?>" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <?php if(isset($editPermissionSection)): ?>
                                        <?php echo html()->form('POST', route('sidebar-manager.section-update'))->open(); ?>

                                        <input type="hidden" name="id" value="<?php echo e($editPermissionSection->id); ?>">
                                    <?php else: ?>
                                        <?php echo html()->form('POST', route('sidebar-manager.section.store', ['role_id' => @$role->id]))->open(); ?>

                                    <?php endif; ?>
                                    <div class="row pt-0">

                                    </div>
                                    
                                    <div id="row_element_div">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for="name"><?php echo e(__('common.name')); ?> <span
                                                                class="textdanger">*</span>
                                                    </label>
                                                    <input type="hidden" name="role_name" value="<?php echo e($role_name); ?>">
                                                    <input class="primary_input_field" type="text" name="name" autocomplete="off" value="<?php echo e(isset($editPermissionSection) ? $editPermissionSection->name : null); ?>"
                                                           placeholder="<?php echo e(__('common.name')); ?>">
                                                    <?php if($errors->has('name')): ?>
                                                        <span class="text-danger" ><?php echo e(@$errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button type="submit"
                                                    class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                <?php echo e(__('common.save')); ?> </button>
                                        </div>
                                    </div>
                                    <?php echo html()->form()->close(); ?>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt_20" id="available_menu_div">
                        <?php echo $__env->make('menumanage::components.available_list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb_20">
            <div class="white-box">
                <input type="hidden" name="data" id="items-data" value="">
                <div class="add-visitor" id="menu_idv">

                    <?php echo $__env->make('menumanage::components.components', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="white-box">
                <div class="add-visitor" id="live_preview_div">
                    <?php echo $__env->make('menumanage::components.live_preview', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>





    <input type="hidden" id="order_change_url" value="<?php echo e(route('sidebar-manager.menu-update')); ?>">

    <input type="hidden" id="section_store_url" value="<?php echo e(route('sidebar-manager.section.store')); ?>">
    <input type="hidden" id="section_delete_url" value="<?php echo e(route('sidebar-manager.remvoeSection')); ?>">
    <input type="hidden" id="menu_delete_url" value="<?php echo e(route('sidebar-manager.menu-store')); ?>">
    <input type="hidden" id="menu_remove_url" value="<?php echo e(route('sidebar-manager.removeMenu')); ?>">

    <input type="hidden" id="section_sort_url" value="<?php echo e(route('sidebar-manager.sort-section')); ?>">
    <input type="hidden" id="role_name" value="<?php echo e($role_name); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('change','#role_id',function(){
                    let role = $(this).val();
                    let url = "<?php echo e(route('menumanage.index')); ?>?role_name="+role;
                    window.location.replace(url);
                });

            });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\Modules/MenuManage\Resources/views/index.blade.php ENDPATH**/ ?>