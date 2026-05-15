
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('rolepermission::role.role_permission'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('/Modules/RolePermission/public/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/Modules/RolePermission/public/css/custom.css')); ?>">

    <section class="sms-breadcrumb mb-20">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('system_settings.role_permission'); ?> </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('system_settings.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('system_settings.role_permission'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <div class="role_permission_wrap">
        <div class="permission_title">
            <h4>Assign Permission (<?php echo e(@$role->name); ?>)</h4>
        </div>
    </div>

    <div class="erp_role_permission_area ">


<?php
    $paid_modules = ['Zoom','University','Gmeet','QRCodeAttendance','BBB','ParentRegistration','InAppLiveClass','AiContent','Lms','Certificate','Jitsi','WhatsappSupport','InfixBiometrics'];
?>
        <!-- single_permission  -->

        <?php echo e(Form::open([
            'class' => 'form-horizontal',
            'files' => true,
            'route' => 'rolepermission/role-permission-assign',
            'method' => 'POST',
        ])); ?>


        <input type="hidden" name="role_id" value="<?php echo e(@$role->id); ?>">

        <div class="mesonary_role_header">


            <?php $__currentLoopData = $all_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($permission->module) && in_array($permission->module, $paid_modules)): ?>
                    <?php if(moduleStatusCheck($permission->module)): ?>
                        <?php if ($__env->exists('rolepermission::inc.permission_list')) echo $__env->make('rolepermission::inc.permission_list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>
                <?php else: ?>    
                    <?php if ($__env->exists('rolepermission::inc.permission_list')) echo $__env->make('rolepermission::inc.permission_list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>


        <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    <?php echo app('translator')->get('submit'); ?>
                </button>
            </div>
        </div>

        <?php echo e(Form::close()); ?>



    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        // Fees Assign
        $('.permission-checkAll').on('click', function() {

            //$('.module_id_'+$(this).val()).prop('checked', this.checked);


            if ($(this).is(":checked")) {
                $('.module_id_' + $(this).val()).each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.module_id_' + $(this).val()).each(function() {
                    $(this).prop('checked', false);
                });
            }
        });



        $('.module_link').on('click', function() {

            var module_id = $(this).parents('.single_permission').attr("id");
            var module_link_id = $(this).val();


            if ($(this).is(":checked")) {
                $(".module_option_" + module_id + '_' + module_link_id).prop('checked', true);
            } else {
                $(".module_option_" + module_id + '_' + module_link_id).prop('checked', false);
            }

            var checked = 0;
            $('.module_id_' + module_id).each(function() {
                if ($(this).is(":checked")) {
                    checked++;
                }
            });

            if (checked > 0) {
                $(".main_module_id_" + module_id).prop('checked', true);
            } else {
                $(".main_module_id_" + module_id).prop('checked', false);
            }
        });




        $('.module_link_option').on('click', function() {

            var module_id = $(this).parents('.single_permission').attr("id");
            var module_link = $(this).parents('.module_link_option_div').attr("id");




            // module link check

            var link_checked = 0;

            $('.module_option_' + module_id + '_' + module_link).each(function() {
                if ($(this).is(":checked")) {
                    link_checked++;
                }
            });

            if (link_checked > 0) {
                $("#Sub_Module_" + module_link).prop('checked', true);
            } else {
                $("#Sub_Module_" + module_link).prop('checked', false);
            }

            // module check
            var checked = 0;

            $('.module_id_' + module_id).each(function() {
                if ($(this).is(":checked")) {
                    checked++;
                }
            });


            if (checked > 0) {
                $(".main_module_id_" + module_id).prop('checked', true);
            } else {
                $(".main_module_id_" + module_id).prop('checked', false);
            }
        });
    </script>
    <!-- <script>
        // $(".arrow").on("click", function(){
        //     $(this).find($("i")).toggleClass('ti-plus').toggleClass('ti-minus');
        // });
    </script> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\Modules/RolePermission\Resources/views/role_permission.blade.php ENDPATH**/ ?>