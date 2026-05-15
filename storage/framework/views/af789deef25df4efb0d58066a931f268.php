<h4><?php echo e(__('common.Menu List')); ?></h4>
<div class="">
    <?php $__env->startPush('css'); ?>
        <link href="<?php echo e(asset('Modules/MenuManage/Resources/assets/css/jquery.nestable.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('Modules/MenuManage/Resources/assets/css/sidebar.css')); ?>" rel="stylesheet">
    <?php $__env->stopPush(); ?>
    <?php
            $paid_modules = ['Zoom','University','Gmeet','QRCodeAttendance','BBB','ParentRegistration','InfixBiometrics','AiContent','Lms','Certificate','Jitsi','WhatsappSupport','InAppLiveClass'];
           
    ?>

    <div class="row">
        <div class="col-xl-12 menu_item_div" id="itemDiv">
           
            <?php if(isset($sidebar_menus)): ?>
                    <?php $__currentLoopData = $sidebar_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sidebar_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                    
                           
                        <div class="closed_section" data-id="<?php echo e($sidebar_menu->id); ?>"  data-parent_section="<?php echo e($sidebar_menu->id); ?>">
                            <div id="accordion" class="dd">
                                <div class="section_nav">
                                    <h5><?php echo e($sidebar_menu->name); ?></h5>
                                    <div class="setting_icons">
                                        <span class="edit-btn">
                                            <a class=" btn-modal" data-container="#commonModal" type="button"
                                                href="<?php echo e(route('sidebar-manager.section-edit-form', [$sidebar_menu->id, 'role_id' => @$sidebar_menu->id,'role_name' => $role_name])); ?>">
                                                <i class="ti-pencil-alt"></i>
                                            </a>

                                        </span>
                                        <i class="ti-close delete_section" data-id="<?php echo e($sidebar_menu->id); ?>"></i>
                                        <i class="ti-angle-up toggle_up_down"></i>
                                    </div>
                                </div>
                            </div>                                
                            <?php if($sidebar_menu->childs->count()): ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="accordion" class="dd menu-list used_menu" 
                                                    data-section="<?php echo e($sidebar_menu->id); ?>">
                                                    <ol class="dd-list">
                                                        <?php $__currentLoopData = $sidebar_menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                            <?php if(!empty($menu->module) && in_array($menu->module, $paid_modules)): ?>
                                                                <?php if(moduleStatusCheck($menu->module)): ?>
                                                                    
                                                                    <li class="dd-item" data-id="<?php echo e($menu->id); ?>" 
                                                                        data-section_id="<?php echo e($menu->parent_id); ?>"
                                                                        data-parent_route="<?php echo e($menu->parent_id); ?>"
                                                                        data-parent="<?php echo e($menu->parent_id); ?>" >
                                                                        <div class="card accordion_card"
                                                                            id="accordion_<?php echo e($menu->id); ?>">
                                                                            <div class="card-header item_header"
                                                                                id="heading_<?php echo e($menu->id); ?>">
                                                                                <div class="dd-handle">
                                                                                    <div class="float-left">
                                                                                        <?php echo e($menu->name); ?>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right btn_div">
                                                                                    <div class="edit_icon">
                                                                                        

                                                                                        <i class="ti-close remove_menu"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <ol class="dd-list">
                                                                            <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                            <?php if(sidebarPermission($submenu)): ?>
                                                                                <li data-id="<?php echo e($submenu->id); ?>" >
                                                                                    <div class="card accordion_card"
                                                                                        id="accordion_<?php echo e($submenu->id); ?>">
                                                                                        <div class="card-header item_header"
                                                                                            id="heading_<?php echo e($submenu->id); ?>">
                                                                                            <div class="dd-handle">
                                                                                                <div class="float-left">
                                                                                                    <?php echo e(__($submenu->lang_name )); ?>

                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        <div class="float-right btn_div">
                                                                                            <div class="edit_icon">
                                                                                                

                                                                                                <i class="ti-close remove_menu"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </ol>
                                                                    </li>  
                                                                    
                                                                <?php endif; ?>
                                                            <?php else: ?>    
                                                                <?php if((sidebarPermission($menu)==true)): ?>
                                                                    <?php if($menu->module == 'fees_collection'  || $menu->module == 'Fees'): ?>
                                                                         <?php if($menu->module == 'Fees' && generalSetting()->fees_status  == 1 ): ?>
                                                                            <li class="dd-item" data-id="<?php echo e($menu->id); ?>" 
                                                                            data-section_id="<?php echo e($menu->parent_id); ?>"
                                                                            data-parent_route="<?php echo e($menu->parent_id); ?>"
                                                                            data-parent="<?php echo e($menu->parent_id); ?>" >
                                                                            <div class="card accordion_card"
                                                                                id="accordion_<?php echo e($menu->id); ?>">
                                                                                <div class="card-header item_header"
                                                                                    id="heading_<?php echo e($menu->id); ?>">
                                                                                    <div class="dd-handle">
                                                                                        <div class="float-left">
                                                                                            <?php echo e($menu->name); ?> 
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="float-right btn_div">
                                                                                        <div class="edit_icon">
                                                                                            
    
                                                                                            <i class="ti-close remove_menu"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
    
                                                                            </div>
    
                                                                            <ol class="dd-list">
                                                                                <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if(sidebarPermission($submenu)): ?>
                                                                                        <li data-id="<?php echo e($submenu->id); ?>" >
                                                                                            <div class="card accordion_card"
                                                                                                id="accordion_<?php echo e($submenu->id); ?>">
                                                                                                <div class="card-header item_header"
                                                                                                    id="heading_<?php echo e($submenu->id); ?>">
                                                                                                    <div class="dd-handle">
                                                                                                        <div class="float-left">
                                                                                                            <?php echo e($submenu->name); ?>

                                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                <div class="float-right btn_div">
                                                                                                    <div class="edit_icon">
                                                                                                        
        
                                                                                                        <i class="ti-close remove_menu"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    <?php endif; ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </ol>
                                                                        </li> 
                                                                         <?php endif; ?>
                                                                         <?php if($menu->module == 'fees_collection' && generalSetting()->fees_status  == 0 ): ?>
                                                                            <li class="dd-item" data-id="<?php echo e($menu->id); ?>" 
                                                                            data-section_id="<?php echo e($menu->parent_id); ?>"
                                                                            data-parent_route="<?php echo e($menu->parent_id); ?>"
                                                                            data-parent="<?php echo e($menu->parent_id); ?>" >
                                                                            <div class="card accordion_card"
                                                                                id="accordion_<?php echo e($menu->id); ?>">
                                                                                <div class="card-header item_header"
                                                                                    id="heading_<?php echo e($menu->id); ?>">
                                                                                    <div class="dd-handle">
                                                                                        <div class="float-left">
                                                                                            <?php echo e($menu->name); ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="float-right btn_div">
                                                                                        <div class="edit_icon">
                                                                                            
    
                                                                                            <i class="ti-close remove_menu"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
    
                                                                            </div>
    
                                                                            <ol class="dd-list">
                                                                                <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if(sidebarPermission($submenu)): ?>
                                                                                        <li data-id="<?php echo e($submenu->id); ?>" >
                                                                                            <div class="card accordion_card"
                                                                                                id="accordion_<?php echo e($submenu->id); ?>">
                                                                                                <div class="card-header item_header"
                                                                                                    id="heading_<?php echo e($submenu->id); ?>">
                                                                                                    <div class="dd-handle">
                                                                                                        <div class="float-left">
                                                                                                            <?php echo e($submenu->name); ?>

                                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                <div class="float-right btn_div">
                                                                                                    <div class="edit_icon">
                                                                                                        
        
                                                                                                        <i class="ti-close remove_menu"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                    <?php endif; ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </ol>
                                                                        </li> 
                                                                         <?php endif; ?>
                                                                    <?php else: ?>   
                                                                    
                                                                        <?php if($menu->route == 'fees.student-fees-list-parent' || $menu->route =='parent-fees'): ?>
                                                                            <?php if($menu->route == 'fees.student-fees-list-parent' && generalSetting()->fees_status  == 1): ?>
                                                                                 <li class="dd-item" data-id="<?php echo e($menu->id); ?>" 
                                                                                    data-section_id="<?php echo e($menu->parent_id); ?>"
                                                                                    data-parent_route="<?php echo e($menu->parent_id); ?>"
                                                                                    data-parent="<?php echo e($menu->parent_id); ?>" >
                                                                                    <div class="card accordion_card"
                                                                                        id="accordion_<?php echo e($menu->id); ?>">
                                                                                        <div class="card-header item_header"
                                                                                            id="heading_<?php echo e($menu->id); ?>">
                                                                                            <div class="dd-handle">
                                                                                                <div class="float-left">
                                                                                                    <?php echo e($menu->name); ?> 
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="float-right btn_div">
                                                                                                <div class="edit_icon">
                                                                                                    
            
                                                                                                    <i class="ti-close remove_menu"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
            
                                                                                    </div>
            
                                                                                    <ol class="dd-list">
                                                                                        <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php if(sidebarPermission($submenu)): ?>
                                                                                                <li data-id="<?php echo e($submenu->id); ?>" >
                                                                                                    <div class="card accordion_card"
                                                                                                        id="accordion_<?php echo e($submenu->id); ?>">
                                                                                                        <div class="card-header item_header"
                                                                                                            id="heading_<?php echo e($submenu->id); ?>">
                                                                                                            <div class="dd-handle">
                                                                                                                <div class="float-left">
                                                                                                                    <?php echo e($submenu->name); ?>

                                                                                                                    
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        <div class="float-right btn_div">
                                                                                                            <div class="edit_icon">
                                                                                                                
                
                                                                                                                <i class="ti-close remove_menu"></i>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                        </li>
                                                                                    <?php endif; ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </ol>
                                                                        </li> 
                                                                            <?php endif; ?>
                                                                            
                                                                            <?php if($menu->route == 'parent-fees' && generalSetting()->fees_status  == 0): ?>
                                                                                 <li class="dd-item" data-id="<?php echo e($menu->id); ?>" 
                                                                                    data-section_id="<?php echo e($menu->parent_id); ?>"
                                                                                    data-parent_route="<?php echo e($menu->parent_id); ?>"
                                                                                    data-parent="<?php echo e($menu->parent_id); ?>" >
                                                                                    <div class="card accordion_card"
                                                                                        id="accordion_<?php echo e($menu->id); ?>">
                                                                                        <div class="card-header item_header"
                                                                                            id="heading_<?php echo e($menu->id); ?>">
                                                                                            <div class="dd-handle">
                                                                                                <div class="float-left">
                                                                                                    <?php echo e($menu->name); ?> 
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="float-right btn_div">
                                                                                                <div class="edit_icon">
                                                                                                    
            
                                                                                                    <i class="ti-close remove_menu"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
            
                                                                                    </div>
            
                                                                                    <ol class="dd-list">
                                                                                        <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php if(sidebarPermission($submenu)): ?>
                                                                                                <li data-id="<?php echo e($submenu->id); ?>" >
                                                                                                    <div class="card accordion_card"
                                                                                                        id="accordion_<?php echo e($submenu->id); ?>">
                                                                                                        <div class="card-header item_header"
                                                                                                            id="heading_<?php echo e($submenu->id); ?>">
                                                                                                            <div class="dd-handle">
                                                                                                                <div class="float-left">
                                                                                                                    <?php echo e($submenu->name); ?>

                                                                                                                    
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        <div class="float-right btn_div">
                                                                                                            <div class="edit_icon">
                                                                                                                
                
                                                                                                                <i class="ti-close remove_menu"></i>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </li>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </ol>
                                                                                </li> 
                                                                            <?php endif; ?>
                                                                            
                                                                        <?php else: ?>    
                                                                             <li class="dd-item" data-id="<?php echo e($menu->id); ?>" 
                                                                                data-section_id="<?php echo e($menu->parent_id); ?>"
                                                                                data-parent_route="<?php echo e($menu->parent_id); ?>"
                                                                                data-parent="<?php echo e($menu->parent_id); ?>" >
                                                                                <div class="card accordion_card"
                                                                                    id="accordion_<?php echo e($menu->id); ?>">
                                                                                    <div class="card-header item_header"
                                                                                        id="heading_<?php echo e($menu->id); ?>">
                                                                                        <div class="dd-handle">
                                                                                            <div class="float-left">
                                                                                                <?php echo e($menu->name); ?> 
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="float-right btn_div">
                                                                                            <div class="edit_icon">
                                                                                                
        
                                                                                                <i class="ti-close remove_menu"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
        
                                                                                </div>
        
                                                                                <ol class="dd-list">
                                                                                    <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php if(sidebarPermission($submenu)): ?>
                                                                                            <li data-id="<?php echo e($submenu->id); ?>" >
                                                                                                <div class="card accordion_card"
                                                                                                    id="accordion_<?php echo e($submenu->id); ?>">
                                                                                                    <div class="card-header item_header"
                                                                                                        id="heading_<?php echo e($submenu->id); ?>">
                                                                                                        <div class="dd-handle">
                                                                                                            <div class="float-left">
                                                                                                                <?php echo e($submenu->name); ?>

                                                                                                                
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    <div class="float-right btn_div">
                                                                                                        <div class="edit_icon">
                                                                                                            
            
                                                                                                            <i class="ti-close remove_menu"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </ol>
                                                                            </li> 
                                                                        <?php endif; ?>
                                                                            
                                                                    <?php endif; ?> 
                                                                <?php endif; ?>  
                                                            <?php endif; ?>
                                                                                                               
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="accordion2" class="dd menu-list used_menu"
                                                    data-section="<?php echo e($sidebar_menu->id); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>


    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('public/backEnd/js/jquery.nestable.min.js')); ?>"></script>
        <script src="<?php echo e(asset('Modules/MenuManage/Resources/assets/js/sidebar.js')); ?>"></script>
    <?php $__env->stopPush(); ?>


</div>
<?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\Modules/MenuManage\Resources/views/components/components.blade.php ENDPATH**/ ?>