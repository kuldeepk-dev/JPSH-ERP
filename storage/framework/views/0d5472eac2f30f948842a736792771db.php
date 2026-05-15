
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('system_settings.manage_currency'); ?>
<?php $__env->stopSection(); ?> 
<?php $__env->startPush('css'); ?>
    <style>
        .badge{
            background: var(--primary-color);
            color: #fff;
            padding: 5px 10px;
            border-radius: 30px;
            display: inline-block;
            font-size: 8px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-20">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('system_settings.currency'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('system_settings.currency'); ?></a>
                    <a href="#"><?php echo app('translator')->get('system_settings.manage_currency'); ?></a>

                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="<?php echo e(route('create-currency')); ?>" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->get('common.add'); ?>
                    </a>
                </div>
            </div>           
          
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-4 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-15"><?php echo app('translator')->get('system_settings.currency_list'); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                    <table id="table_id" class="table dataTable no-footer dtr-inline collapsed" cellspacing="0" width="100%" role="grid" aria-describedby="table_id_info" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('common.sl'); ?></th>
                                            <th><?php echo app('translator')->get('common.name'); ?></th>
                                            <th><?php echo app('translator')->get('system_settings.code'); ?></th>
                                            <th><?php echo app('translator')->get('system_settings.symbol'); ?></th> 
                                            <th><?php echo app('translator')->get('common.type'); ?></th>
                                            <th><?php echo app('translator')->get('system_settings.currency_position'); ?></th> 
                                            <th><?php echo app('translator')->get('system_settings.space'); ?></th> 
                                            <th><?php echo app('translator')->get('system_settings.decimal_digit'); ?></th> 
                                            <th><?php echo app('translator')->get('system_settings.decimal_separator'); ?></th> 
                                            <th><?php echo app('translator')->get('system_settings.thousand_separator'); ?></th> 
                                            <th><?php echo app('translator')->get('common.action'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1;  ?>
    
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($i++); ?>

                                                <td><?php echo e(@$value->name); ?> 
                                                    <?php if($value->active): ?> 
                                                        <span class="badge fix-gr-bg"><?php echo e(__('common.active')); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(@$value->code); ?></td>
                                                <td><?php echo e(@$value->symbol); ?></td> 
                                                <td><?php echo e(@$value->type); ?></td>
                                                <td><?php echo e(@$value->position); ?></td>
                                                <td><?php echo e(@$value->space ? __('common.yes') : __('common.no')); ?></td> 
                                                <td><?php echo e(@$value->decimal_digit); ?></td>
                                                <td><?php echo e(@$value->decimal_separator); ?></td>
                                                <td><?php echo e(@$value->thousand_separator); ?></td> 
                                                <td>
    
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
                                                        <?php if(userPermission('currency_edit')): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('currency_edit', [@$value->id])); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(userPermission('currency_delete')): ?>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteCurrency<?php echo e(@$value->id); ?>"  href="<?php echo e(route('currency_delete', [@$value->id])); ?>"><?php echo app('translator')->get('common.delete'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(in_array(auth()->user()->role_id, [1, 5])): ?>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#activeCurrency<?php echo e(@$value->id); ?>"  href="<?php echo e(route('currency_delete', [@$value->id])); ?>"><?php echo app('translator')->get('common.active'); ?></a>
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
                                                </td>
    
                                                    <div class="modal fade admin-query" id="activeCurrency<?php echo e(@$value->id); ?>" >
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><?php echo app('translator')->get('system_settings.active_currency'); ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center">
                                                                        <h4><?php echo app('translator')->get('system_settings.are_you_sure_to_active ?'); ?> </h4>
                                                                    </div>
                                                                    <div class="mt-40 d-flex justify-content-between">
                                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                                        <a href="<?php echo e(route('currency_active', [@$value->id])); ?>" class="text-light">
                                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.active'); ?></button>
                                                                        </a>
                                                                    </div>
                                                                </div>
    
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="modal fade admin-query" id="deleteCurrency<?php echo e(@$value->id); ?>" >
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><?php echo app('translator')->get('system_settings.delete_currency'); ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center">
                                                                        <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                                    </div>
                                                                    <div class="mt-40 d-flex justify-content-between">
                                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                                        <a href="<?php echo e(route('currency_delete', [@$value->id])); ?>" class="text-light">
                                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
                                                                        </a>
                                                                    </div>
                                                                </div>
    
                                                            </div>
                                                        </div>
                                                    </div> 
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.partials.data_table_js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\resources\views/backEnd/systemSettings/manageCurrency.blade.php ENDPATH**/ ?>