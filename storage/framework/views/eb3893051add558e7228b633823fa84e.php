<?php
     $new_fees = ['fees.fees-group','fees.due-fees','fees.fees-type','fees.fine-report','fees','fees.fees-invoice-list','fees.payment-report','fees-invoice-bulk-print','fees.bank-payment','fees.balance-report','fees-invoice-bulk-print-settings','fees_forward','fees.waiver-report'];
     $old_fees = ['fees_statement','balance_fees_report','transaction_report','fine-report','fees-bulk-print', 'fees_group', 'fees_type','fees-master','fees_discount','collect_fees','search_fees_payment','search_fees_due','fees_forward','bank-payment-slip'];
?>

<?php if(in_array($row2->route, $new_fees) || in_array($row2->route, $old_fees)): ?>
    <?php if(in_array($row2->route, $new_fees) && generalSetting()->fees_status  == 1): ?>
        <?php if(in_array( $row2->route, $default_theme) || in_array($row2->route, $edulia_theme)): ?>                                            
            <?php if(in_array( $row2->route, $default_theme) && $active_theme == 'default'): ?>
                <li>
                    <div class="submodule">
                        <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                            value="<?php echo e($row2->id); ?>"
                            class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                            type="checkbox"
                            <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                        <label
                            for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(__( $row2->lang_name)); ?>  </label>
                        <br>
                    </div>

                    <ul class="option mt-20">

                        <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                    <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                        value="<?php echo e($row3->id); ?>"
                                        class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                        type="checkbox"
                                        <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                    <label
                                        for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                                    <br>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </li>
            <?php endif; ?>
            <?php if(in_array( $row2->route, $edulia_theme) && $active_theme == 'edulia'): ?>
                <li>
                    <div class="submodule">
                        <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                            value="<?php echo e($row2->id); ?>"
                            class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                            type="checkbox"
                            <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                        <label
                            for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(__( $row2->lang_name)); ?></label>
                        <br>
                    </div>

                    <ul class="option mt-20">

                        <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                    <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                        value="<?php echo e($row3->id); ?>"
                                        class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                        type="checkbox"
                                        <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                    <label
                                        for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                                    <br>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </li>
            <?php endif; ?>                                            
        <?php else: ?>     
            <li>
                <div class="submodule">
                    <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                        value="<?php echo e($row2->id); ?>"
                        class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                        type="checkbox"
                        <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                    <label
                        for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(!empty($row2->lang_name) ?  __( $row2->lang_name):$row2->name); ?>  </label>
                    <br>
                </div>

                <ul class="option mt-20">

                    <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($row3->module)): ?>
                            <?php if(moduleStatusCheck($row3->module)): ?>
                                <li>
                                    <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                        <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                            value="<?php echo e($row3->id); ?>"
                                            class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                            type="checkbox"
                                            <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                        <label
                                            for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?>  </label>
                                        <br>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>   
                            <li>
                                <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                    <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                        value="<?php echo e($row3->id); ?>"
                                        class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                        type="checkbox"
                                        <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                    <label
                                        for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                                    <br>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </li>
        <?php endif; ?>

    <?php endif; ?>

    <?php if(in_array($row2->route, $old_fees) && generalSetting()->fees_status  == 0): ?>
        <?php if(in_array( $row2->route, $default_theme) || in_array($row2->route, $edulia_theme)): ?>                                            
            <?php if(in_array( $row2->route, $default_theme) && $active_theme == 'default'): ?>
                <li>
                    <div class="submodule">
                        <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                            value="<?php echo e($row2->id); ?>"
                            class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                            type="checkbox"
                            <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                        <label
                            for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(__( $row2->lang_name)); ?></label>
                        <br>
                    </div>

                    <ul class="option mt-20">

                        <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                    <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                        value="<?php echo e($row3->id); ?>"
                                        class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                        type="checkbox"
                                        <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                    <label
                                        for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                                    <br>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </li>
            <?php endif; ?>
            <?php if(in_array( $row2->route, $edulia_theme) && $active_theme == 'edulia'): ?>
                <li>
                    <div class="submodule">
                        <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                            value="<?php echo e($row2->id); ?>"
                            class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                            type="checkbox"
                            <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                        <label
                            for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(__( $row2->lang_name)); ?></label>
                        <br>
                    </div>

                    <ul class="option mt-20">

                        <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                    <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                        value="<?php echo e($row3->id); ?>"
                                        class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                        type="checkbox"
                                        <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                    <label
                                        for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                                    <br>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </li>
            <?php endif; ?>                                            
        <?php else: ?>     
            <li>
                <div class="submodule">
                    <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                        value="<?php echo e($row2->id); ?>"
                        class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                        type="checkbox"
                        <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                    <label
                        for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(!empty($row2->lang_name) ?  __( $row2->lang_name):$row2->name); ?>  </label>
                    <br>
                </div>

                <ul class="option mt-20">

                    <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($row3->module)): ?>
                            <?php if(moduleStatusCheck($row3->module)): ?>
                                <li>
                                    <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                        <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                            value="<?php echo e($row3->id); ?>"
                                            class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                            type="checkbox"
                                            <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                        <label
                                            for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                                        <br>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>   
                            <li>
                                <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                    <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                        value="<?php echo e($row3->id); ?>"
                                        class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                        type="checkbox"
                                        <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                    <label
                                        for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                                    <br>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </li>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>    
<?php if(in_array( $row2->route, $default_theme) || in_array($row2->route, $edulia_theme)): ?>                                            
    <?php if(in_array( $row2->route, $default_theme) && $active_theme == 'default'): ?>
        <li>
            <div class="submodule">
                <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                    value="<?php echo e($row2->id); ?>"
                    class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                    type="checkbox"
                    <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                <label
                    for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(__( $row2->lang_name)); ?></label>
                <br>
            </div>

            <ul class="option mt-20">

                <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                            <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                value="<?php echo e($row3->id); ?>"
                                class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                type="checkbox"
                                <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                            <label
                                for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                            <br>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>
        </li>
    <?php endif; ?>
    <?php if(in_array( $row2->route, $edulia_theme) && $active_theme == 'edulia'): ?>
        <li>
            <div class="submodule">
                <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                    value="<?php echo e($row2->id); ?>"
                    class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                    type="checkbox"
                    <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

                <label
                    for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(__( $row2->lang_name)); ?></label>
                <br>
            </div>

            <ul class="option mt-20">

                <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                            <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                value="<?php echo e($row3->id); ?>"
                                class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                type="checkbox"
                                <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                            <label
                                for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                            <br>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>
        </li>
    <?php endif; ?>                                            
<?php else: ?>   

 <?php if(!empty($row2->module)): ?>
        <?php if(moduleStatusCheck($row2->module)): ?>
            <li>
        <div class="submodule">
            <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                value="<?php echo e($row2->id); ?>"
                class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                type="checkbox"
                <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

            <label
                for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(!empty($row2->lang_name) ?  __( $row2->lang_name):$row2->name); ?>  </label>
            <br>
        </div>

        <ul class="option mt-20">

            <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($row3->module)): ?>
                    <?php if(moduleStatusCheck($row3->module)): ?>
                        <li>
                            <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                    value="<?php echo e($row3->id); ?>"
                                    class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                    type="checkbox"
                                    <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                <label
                                    for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?>  </label>
                                <br>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php else: ?>   
                    <li>
                        <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                            <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                value="<?php echo e($row3->id); ?>"
                                class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                type="checkbox"
                                <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                            <label
                                for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                            <br>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </li>
        <?php endif; ?>
 <?php else: ?>  
    <li>
        <div class="submodule">
            <input id="Sub_Module_<?php echo e($row2->id); ?>" name="module_id[]"
                value="<?php echo e($row2->id); ?>"
                class="infix_csk common-radio  module_id_<?php echo e($permission->id); ?> module_link"
                type="checkbox"
                <?php echo e(in_array($row2->id, $already_assigned) ? 'checked' : ''); ?>>

            <label
                for="Sub_Module_<?php echo e($row2->id); ?>"><?php echo e(!empty($row2->lang_name) ?  __( $row2->lang_name):$row2->name); ?>  </label>
            <br>
        </div>

        <ul class="option mt-20">

            <?php $__currentLoopData = $row2->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($row3->module)): ?>
                    <?php if(moduleStatusCheck($row3->module)): ?>
                        <li>
                            <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                                <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                    value="<?php echo e($row3->id); ?>"
                                    class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                    type="checkbox"
                                    <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                                <label
                                    for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?>  </label>
                                <br>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php else: ?>   
                    <li>
                        <div class="module_link_option_div" id="<?php echo e($row2->id); ?>">
                            <input id="Option_<?php echo e($row3->id); ?>" name="module_id[]"
                                value="<?php echo e($row3->id); ?>"
                                class="infix_csk common-radio    module_id_<?php echo e($permission->id); ?> module_option_<?php echo e($permission->id); ?>_<?php echo e($row2->id); ?> module_link_option"
                                type="checkbox"
                                <?php echo e(in_array($row3->id, $already_assigned) ? 'checked' : ''); ?>>

                            <label
                                for="Option_<?php echo e($row3->id); ?>"><?php echo e(__('rolepermission::permissions.' . $row3->name)); ?></label>
                            <br>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </li>
    
 <?php endif; ?>
<?php endif; ?>
<?php endif; ?>  


<?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\Modules/RolePermission\Resources/views/inc/permission_row.blade.php ENDPATH**/ ?>