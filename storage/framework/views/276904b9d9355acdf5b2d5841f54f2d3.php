<h4><?php echo e(__('menumanage::menuManage.Live Preview')); ?></h4>
<div class="mt_30">
    <?php
        $paid_modules = ['Zoom','University','Gmeet','QRCodeAttendance','BBB','ParentRegistration','InfixBiometrics','AiContent','Lms','Certificate','Jitsi','WhatsappSupport','InAppLiveClass'];
        $module_enable = false;
        foreach($paid_modules as $module){
            if(moduleStatusCheck($module))
            {
                $module_enable = true;
            }
        }
    ?>
    <nav class="preview_menu_wrapper">
        <ul id="previewMenu">

            <?php if(isset($sidebar_menus)): ?>
            
                <?php $__currentLoopData = $sidebar_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preview_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($preview_section->route == 'module_section'): ?>    
                            <?php if($module_enable): ?>
                                <?php if($preview_section->childs->count() > 0): ?>
                                    <li class="preview_section">
                                        <?php echo e(__(@$preview_section->lang_name)); ?>

                                    </li>
                                    
                                    <?php $__currentLoopData = @$preview_section->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($item->module) && in_array($item->module, $paid_modules)): ?>
                                            <?php if(moduleStatusCheck($item->module)): ?>
                                                        <?php if(sidebarPermission($item)==true): ?>                                        
                                                        <li class="">
                                                            <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                                <div class="nav_icon_small">
                                                                    <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                                </div>
                                                                <div class="nav_title">
                                                                    <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if($item->childs->count()): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>    
                                            <?php if(sidebarPermission($item)==true): ?>
                                                
                                                <?php if($item->module == 'Fees' || $item->module == 'fees_collection'): ?>
                                                    <?php if($item->module == 'Fees' && generalSetting()->fees_status  == 1 ): ?>
                                                         <li class="">
                                                            <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                                <div class="nav_icon_small">
                                                                    <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                                </div>
                                                                <div class="nav_title">
                                                                    <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?> <?php echo e($item->module); ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if($item->childs->count()): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?> <?php echo e($item->module); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if($item->module == 'fees_collection' && generalSetting()->fees_status  == 0 ): ?>
                                                         <li class="">
                                                            <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                                <div class="nav_icon_small">
                                                                    <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                                </div>
                                                                <div class="nav_title">
                                                                    <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?> <?php echo e($item->module); ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if($item->childs->count()): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?> <?php echo e($item->module); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php else: ?>   
                                                 <li class="">
                                                    <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                        <div class="nav_icon_small">
                                                            <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                        </div>
                                                        <div class="nav_title">
                                                            <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                        </div>
                                                    </a>
                                                    <?php if($item->childs->count()): ?>
                                                        <ul>
                                                            <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li>
                                                                    <a href="#">
                                                                        <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?> <?php echo e($item->module); ?>

                                                                    </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                                <?php endif; ?>

                                               
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>    
                            <?php if($preview_section->childs->count() > 0): ?>
                                <li class="preview_section">
                                    <?php echo e(__(@$preview_section->lang_name)); ?>

                                </li>
                                
                                <?php $__currentLoopData = @$preview_section->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($item->module) && in_array($item->module, $paid_modules)): ?>
                                        <?php if(moduleStatusCheck($item->module)): ?>
                                                    <?php if(sidebarPermission($item)==true): ?>                                        
                                                    <li class="">
                                                        <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                            <div class="nav_icon_small">
                                                                <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                            </div>
                                                            <div class="nav_title">
                                                                <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                            </div>
                                                        </a>
                                                        <?php if($item->childs->count()): ?>
                                                            <ul>
                                                                <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li>
                                                                        <a href="#">
                                                                            <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?>

                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>    
                                        <?php if(sidebarPermission($item)==true): ?>
                                             <?php if($item->module == 'Fees'  || $item->module == 'fees_collection'): ?>
                                                    <?php if($item->module == 'Fees' && generalSetting()->fees_status  == 1 ): ?>
                                                        <li class="">
                                                            <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                                <div class="nav_icon_small">
                                                                    <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                                </div>
                                                                <div class="nav_title">
                                                                    <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if($item->childs->count()): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?> 
                                                    
                                                    
                                                    <?php if($item->module == 'fees_collection' && generalSetting()->fees_status  == 0 ): ?>
                                                        <li class="">
                                                            <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                                <div class="nav_icon_small">
                                                                    <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                                </div>
                                                                <div class="nav_title">
                                                                    <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if($item->childs->count()): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                             <?php else: ?>   
                                             
                                              <?php if($item->route == 'fees.student-fees-list-parent' || $item->route =='parent-fees'): ?>
                                                    <?php if($item->route == 'fees.student-fees-list-parent' && generalSetting()->fees_status  == 1): ?>)
                                                        <li class="">
                                                            <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                                <div class="nav_icon_small">
                                                                    <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                                </div>
                                                                <div class="nav_title">
                                                                    <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if($item->childs->count()): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    
                                                    <?php if( $item->route =='parent-fees' &&   generalSetting()->fees_status  == 0): ?>
                                                        <li class="">
                                                            <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                                <div class="nav_icon_small">
                                                                    <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                                </div>
                                                                <div class="nav_title">
                                                                    <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if($item->childs->count()): ?>
                                                                <ul>
                                                                    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                              <?php else: ?>   
                                                    <li class="">
                                                        <a href="#" class="<?php if($item->childs->count()): ?> has-arrow <?php endif; ?>">
                                                            <div class="nav_icon_small">
                                                                <span class="<?php echo e($item->icon ?? 'fas fa-th'); ?>"></span>
                                                            </div>
                                                            <div class="nav_title">
                                                                <span><?php echo e($item ? __($item->lang_name ??  $item->name) : 'no'); ?></span>
                                                            </div>
                                                        </a>
                                                        <?php if($item->childs->count()): ?>
                                                            <ul>
                                                                <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li>
                                                                        <a href="#">
                                                                            <?php echo e(!empty($submenu->lang_name) ? __($submenu->lang_name):$submenu->name); ?>

                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\Modules/MenuManage\Resources/views/components/live_preview.blade.php ENDPATH**/ ?>