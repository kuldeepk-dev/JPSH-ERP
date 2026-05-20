<?php if (isset($component)) { $__componentOriginalf5ee9bc45d6af00850b10ff7521278be = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf5ee9bc45d6af00850b10ff7521278be = $attributes; } ?>
<?php $component = App\View\Components\DropDown::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('drop-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DropDown::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if((isset($role) && $role == 'admin') || $role == 'lms'): ?>
        <?php if(userPermission('fees.fees-view-payment')): ?>
            <a class="dropdown-item" onclick="viewPaymentDetailModal(<?php echo e($row->id); ?>)"><?php echo app('translator')->get('inventory.view_payment'); ?></a>
        <?php endif; ?>
        <?php if($balance == 0): ?>
            <?php if(userPermission('fees.fees-invoice-view')): ?>
                <a class="dropdown-item"
                    href="<?php echo e(route('fees.fees-invoice-view', ['id' => $row->id, 'state' => 'view'])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
            <?php endif; ?>
        <?php else: ?>
            <?php if($paid_amount > 0): ?>
                <?php if(userPermission('fees.fees-invoice-view')): ?>
                    <a class="dropdown-item"
                        href="<?php echo e(route('fees.fees-invoice-view', ['id' => $row->id, 'state' => 'view'])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                <?php endif; ?>
                <?php if(userPermission('fees.add-fees-payment')): ?>
                    <a class="dropdown-item"
                        href="<?php echo e(route('fees.add-fees-payment', $row->id)); ?>"><?php echo app('translator')->get('inventory.add_payment'); ?></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if(userPermission('fees.fees-invoice-view')): ?>
                    <a class="dropdown-item"
                        href="<?php echo e(route('fees.fees-invoice-view', ['id' => $row->id, 'state' => 'view'])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                <?php endif; ?>
                <?php if(userPermission('fees.add-fees-payment')): ?>
                    <a class="dropdown-item"
                        href="<?php echo e(route('fees.add-fees-payment', $row->id)); ?>"><?php echo app('translator')->get('inventory.add_payment'); ?></a>
                <?php endif; ?>

                <?php if(userPermission('fees.fees-invoice-edit')): ?>
                    <a class="dropdown-item"
                        href="<?php echo e(route('fees.fees-invoice-edit', $row->id)); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                <?php endif; ?>

                <?php if(userPermission('fees.fees-invoice-delete')): ?>
                    <a class="dropdown-item" onclick="feesInvoiceDelete(<?php echo e($row->id); ?>)" data-toggle="modal"
                        data-target="#deleteFeesPayment<?php echo e($row->id); ?>"
                        href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($amount == 0 && $balance == 0 && $paid_amount == 0): ?>
            <?php if(userPermission('fees.fees-invoice-delete')): ?>
                <a class="dropdown-item" onclick="feesInvoiceDelete(<?php echo e($row->id); ?>)" data-toggle="modal"
                    data-target="#deleteFeesPayment<?php echo e($row->id); ?>"
                    href="#"><?php echo app('translator')->get('common.delete'); ?></a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf5ee9bc45d6af00850b10ff7521278be)): ?>
<?php $attributes = $__attributesOriginalf5ee9bc45d6af00850b10ff7521278be; ?>
<?php unset($__attributesOriginalf5ee9bc45d6af00850b10ff7521278be); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf5ee9bc45d6af00850b10ff7521278be)): ?>
<?php $component = $__componentOriginalf5ee9bc45d6af00850b10ff7521278be; ?>
<?php unset($__componentOriginalf5ee9bc45d6af00850b10ff7521278be); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\Modules/Fees\Resources/views/__allFeesListAction.blade.php ENDPATH**/ ?>