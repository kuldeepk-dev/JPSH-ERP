

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('system_settings.email_settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    .smtp_wrapper{
        display: none;
    }
    .smtp_wrapper_block{
        display: block;
    }
    .student-details .nav-tabs .nav-link {
        background: transparent;
    }
    .student-details .nav-tabs .nav-link.active {
        background: #cad5f3;
    }
</style>
<section class="sms-breadcrumb mb-20">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('system_settings.email_settings'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('system_settings.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('system_settings.email_settings'); ?> </a>
            </div>
        </div>
    </div>
</section>


<section class="mb-40 student-details white-box">
    <div class="row">
        <div class="col-lg-8 col-sm-7">
            <div class="main-title">
                <h3 class="mb-15"> <?php echo app('translator')->get('system_settings.select_email_settings'); ?></h3>
            </div>
        </div>
        <div class="col-lg-4 col-sm-5 text-sm-right">
            <?php echo e(html()->form('POST', url('send-test-mail'))->attributes([
                'class' => 'form-horizontal',
                'files' => true,
                'id' => 'email_settings1',
                'enctype' => 'multipart/form-data',
            ])->open()); ?>

                <?php echo csrf_field(); ?>
                <button class="primary-btn small fix-gr-bg" type="submit"> <i class="ti-email"></i> <?php echo e(__('Send Test Mail')); ?> </button>
            <?php echo e(html()->form()->close()); ?>

        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <!-- Start Sms Details -->
            <div class="col-lg-12">
                <ul class="nav nav-tabs tab_column" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?php if($active_mail_driver == 'smtp'): ?> active <?php endif; ?> " href="#smtp" role="tab" data-toggle="tab">Smtp <?php echo app('translator')->get('system_settings.settings'); ?></a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link <?php if($active_mail_driver == 'php'): ?> active <?php endif; ?>" href="#php" role="tab" data-toggle="tab">Php <?php echo app('translator')->get('system_settings.settings'); ?></a>
                    </li>
                    </li>  
                </ul>
                <div class="tab-content p-15">
                    <!-- Start Exam Tab -->
                    <div role="tabpanel" class="tab-pane fade <?php if($active_mail_driver == 'smtp'): ?> show active <?php endif; ?>" id="smtp">
                        <?php if(userPermission('update-email-settings-data')): ?>
                        <?php echo e(html()->form('POST', url('update-email-settings-data'))->attributes([
                            'class' => 'form-horizontal',
                            'files' => true,
                            'id' => 'email_settings1',
                            'enctype' => 'multipart/form-data',
                        ])->open()); ?>

                        <?php endif; ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <input type="hidden" name="email_settings_url" id="email_settings_url" value="update-email-settings-data">
                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                                    <input type="hidden" name="engine_type" id="engine_type" value="smtp">
                                    <div class="row justify-content-center mb-15">
                                        <div class="col-lg-6">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.from_name'); ?><span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('from_name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="from_name" id="from_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->from_name : ''); ?>">
                                                
                                                
                                                <?php if($errors->has('from_name')): ?>
                                                <span class="text-danger" >
                                                    <?php echo e($errors->first('from_name')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.from_mail'); ?><span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('from_email') ? ' is-invalid' : ''); ?>"
                                                type="text" name="from_email" id="from_email" autocomplete="off" value="<?php echo e(isset($editData)? $editData->from_email : ''); ?>">
                                                
                                                
                                                <?php if($errors->has('from_email')): ?>
                                                <span class="text-danger" >
                                                    <?php echo e($errors->first('from_email')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 mb-15">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.mail_driver'); ?> <span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('mail_driver') ? ' is-invalid' : ''); ?>"
                                                type="text" name="mail_driver" id="mail_driver" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_driver : ''); ?>">
                                               
                                                
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-15">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.mail_host'); ?> <span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('mail_host') ? ' is-invalid' : ''); ?>"
                                                type="text" name="mail_host" id="mail_host" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_host : ''); ?>">
                                             
                                                
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 mb-15">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.mail_port'); ?> <span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('mail_port') ? ' is-invalid' : ''); ?>"
                                                type="text" name="mail_port" id="mail_port" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_port : ''); ?>">
                                              
                                                
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-15">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.mail_username'); ?> <span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('mail_username') ? ' is-invalid' : ''); ?>"
                                                type="text" name="mail_username" id="mail_username" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_username : ''); ?>">
                                                
                                                
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 mb-15">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.mail_password'); ?> <span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('mail_password') ? ' is-invalid' : ''); ?>"
                                                type="password" name="mail_password" id="mail_password" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_password : ''); ?>">
                                                
                                                
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-15">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.mail_encryption'); ?> <span class="text-danger"> *</span> </label>
                                                <input class="primary_input_field form-control<?php echo e($errors->has('mail_encryption') ? ' is-invalid' : ''); ?>"
                                                type="text" name="mail_encryption" id="mail_encryption" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_encryption : ''); ?>">
                                                
                                                
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-15">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('common.status'); ?> <span class="text-danger"> *</span> </label>
                                                <select class="primary_select form-control <?php echo e($errors->has('active_status') ? ' is-invalid' : ''); ?>" id="active_status" name="active_status">
                                                    <option data-display="<?php echo app('translator')->get('system_settings.select_status'); ?> *" value=""><?php echo app('translator')->get('system_settings.select_status'); ?> *</option>
                                                    <option <?php if($active_mail_driver == "smtp"): ?> selected <?php endif; ?> value="1"><?php echo app('translator')->get('system_settings.enable'); ?></option>
                                                    <option value="0" disabled><?php echo app('translator')->get('common.disable'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-30">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                <?php echo app('translator')->get('system_settings.update'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(html()->form()->close()); ?>

                    </div>
                    <div role="tabpanel" class="tab-pane fade <?php if($active_mail_driver == 'php'): ?> show active <?php endif; ?>" id="php">
                        <?php if(userPermission('update-email-settings-data')): ?>
                        <?php echo e(html()->form('POST', url('update-email-settings-data'))->attributes([
                            'class' => 'form-horizontal',
                            'files' => true,
                            'id' => 'email_settings1',
                            'enctype' => 'multipart/form-data',
                        ])->open()); ?>

                        <?php endif; ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="hidden" name="email_settings_url" id="email_settings_url" value="update-email-settings-data">
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                                        <input type="hidden" name="engine_type" id="engine_type" value="php">
                                        <div class="row justify-content-center mb-15">
                                            <div class="col-lg-4">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.from_name'); ?><span class="text-danger"> *</span> </label>
                                                    <input class="primary_input_field form-control<?php echo e($errors->has('from_name') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="from_name" id="from_name" autocomplete="off" value="<?php echo e(isset($editDataPhp)? $editDataPhp->from_name : ''); ?>">
                                                    
                                                    
                                                    <?php if($errors->has('from_name')): ?>
                                                    <span class="text-danger" >
                                                        <?php echo e($errors->first('from_name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for=""><?php echo app('translator')->get('system_settings.from_mail'); ?><span class="text-danger"> *</span> </label>
                                                    <input class="primary_input_field form-control<?php echo e($errors->has('from_email') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="from_email" id="from_email" autocomplete="off" value="<?php echo e(isset($editDataPhp)? $editDataPhp->from_email : ''); ?>">
                                                    
                                                    
                                                    <?php if($errors->has('from_email')): ?>
                                                    <span class="text-danger" >
                                                        <?php echo e($errors->first('from_email')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-15">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for=""><?php echo app('translator')->get('common.status'); ?><span class="text-danger"> *</span> </label>
                                                    <select class="primary_select form-control <?php echo e($errors->has('active_status') ? ' is-invalid' : ''); ?>" id="active_status" name="active_status">
                                                        <option data-display="<?php echo app('translator')->get('system_settings.select_status'); ?> *" value=""><?php echo app('translator')->get('system_settings.select_status'); ?> *</option>
                                                        <option <?php if($active_mail_driver == "php"): ?> selected <?php endif; ?> value="1"><?php echo app('translator')->get('system_settings.enable'); ?></option>
                                                        <option value="0" disabled><?php echo app('translator')->get('common.disable'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-30">
                                            <div class="col-lg-12 text-center">
                                                <button class="primary-btn fix-gr-bg">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('system_settings.update'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        <?php echo e(html()->form()->close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\resources\views/backEnd/systemSettings/emailSettingsView.blade.php ENDPATH**/ ?>