<?php
     $default_theme  = ['course-heading-update','admin-home-page','custom-links','social-media','From Download','class-exam-routine-page','course-details-heading','news-heading-update','exam-result-page','contact-page','about-page','conpactPage'];
     $edulia_theme = ['home-slider','pagebuilder','expert-teacher','photo-gallery','video-gallery','front-result','front-class-routine','front-exam-routine','front-academic-calendar','admin-home-page'];
     $active_theme = activeTheme();
     $paid_modules = ['Zoom','University','Gmeet','QRCodeAttendance','BBB','ParentRegistration','InAppLiveClass','AiContent','Lms','Certificate','Jitsi','WhatsappSupport','InfixBiometrics'];
?>
<div class="single_role_blocks">
                    <div class="single_permission" id="<?php echo e($permission->id); ?>">

                        <div class="permission_header d-flex align-items-center justify-content-between">

                            <div>
                                <input type="checkbox" name="module_id[]" value="<?php echo e($permission->id); ?>"
                                    id="Main_Module_<?php echo e($key); ?>"
                                    class="common-radio permission-checkAll main_module_id_<?php echo e($permission->id); ?>"
                                    <?php echo e(in_array($permission->id, $already_assigned) ? 'checked' : ''); ?>>
                                <label
                                    for="Main_Module_<?php echo e($key); ?>"><?php echo e(__($permission->lang_name)); ?></label>
                            </div>

                            <div class="arrow collapsed" data-toggle="collapse" data-target="#Role<?php echo e($permission->id); ?>">


                            </div>

                        </div>

                        <div id="Role<?php echo e($permission->id); ?>" class="collapse">
                            <div class="permission_body">
                                <ul>
                                    <?php $__currentLoopData = $permission->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($row2->module) && in_array($permission->module, $paid_modules) ): ?>
                                            <?php if(moduleStatusCheck($row2->module)): ?>
                                              <?php if ($__env->exists('rolepermission::inc.permission_row')) echo $__env->make('rolepermission::inc.permission_row', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            <?php endif; ?>
                                        <?php else: ?>   
                                             <?php if ($__env->exists('rolepermission::inc.permission_row')) echo $__env->make('rolepermission::inc.permission_row', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                            </div>
                        </div>
                    </div>
</div><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\Modules/RolePermission\Resources/views/inc/permission_list.blade.php ENDPATH**/ ?>