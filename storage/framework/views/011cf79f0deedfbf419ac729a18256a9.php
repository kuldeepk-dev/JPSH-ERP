
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('common.class'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-20">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('common.class'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('academics.academics'); ?></a>
                    <a href="#"><?php echo app('translator')->get('common.class'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($sectionId)): ?>
                <?php if(userPermission('class_store')): ?>
                    <div class="row">
                        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                            <a href="<?php echo e(route('class')); ?>" class="primary-btn small fix-gr-bg">
                                <span class="ti-plus pr-2"></span>
                                <?php echo app('translator')->get('common.add'); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="row">
                <?php if(userPermission('class_store') || isset($sectionId)): ?>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($sectionId)): ?>
                                <?php echo e(html()->form('POST', route('class_update'))->attribute('class', 'form-horizontal')->attribute('files', true)->open()); ?>

                            <?php else: ?>
                                <?php if(userPermission('class_store')): ?>
                                    <?php echo e(html()->form('POST', route('class_store'))->attribute('class', 'form-horizontal')->attribute('files', true)->open()); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="main-title">
                                    <h3 class="mb-15">
                                        <?php if(isset($sectionId)): ?>
                                            <?php echo app('translator')->get('academics.edit_class'); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->get('academics.add_class'); ?>
                                        <?php endif; ?>
                                    </h3>
                                </div>
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo app('translator')->get('common.name'); ?> <span
                                                        class="text-danger"> *</span></label>
                                                <input
                                                    class="primary_input_field form-control<?php echo e(@$errors->has('name') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="name" autocomplete="off"
                                                    value="<?php echo e(isset($classById) ? @$classById->class_name : ''); ?>">
                                                <input type="hidden" name="id"
                                                    value="<?php echo e(isset($classById) ? $classById->id : ''); ?>">


                                                <?php if($errors->has('name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e(@$errors->first('name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(generalSetting()->result_type == 'mark'): ?>
                                        <div class="row mt-25">
                                            <div class="col-lg-12">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for=""><?php echo app('translator')->get('exam.pass_mark'); ?>
                                                        <span class="text-danger"> *</span></label>
                                                    <input
                                                        class="primary_input_field form-control<?php echo e(@$errors->has('pass_mark') ? ' is-invalid' : ''); ?>"
                                                        type="text" name="pass_mark" autocomplete="off"
                                                        value="<?php echo e(isset($classById) ? @$classById->pass_mark : ''); ?>">


                                                    <?php if($errors->has('pass_mark')): ?>
                                                        <span class="text-danger">
                                                            <?php echo e(@$errors->first('pass_mark')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for="board_name">Boards</label>
                                                <select class="primary_select form-control<?php echo e(@$errors->has('board_name') ? ' is-invalid' : ''); ?>" name="board_name" id="board_name">
                                                    <option data-display="Select Boards" value="">Select Boards</option>
                                                    <?php $__currentLoopData = generalBoards(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($board); ?>" <?php echo e((isset($classById) && @$classById->board_name == $board) || (!isset($classById) && selectedBoard() === $board) ? 'selected' : ''); ?>>
                                                            <?php echo e($board); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('board_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e(@$errors->first('board_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(shiftEnable()): ?>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label" for=""><?php echo app('translator')->get('common.shift'); ?><span class="text-danger"> *</span></label>
                                            <?php $__currentLoopData = shifts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="">
                                                    <?php if(isset($shiftId)): ?>
                                                        <input type="checkbox" id="shift<?php echo e(@$shift->id); ?>"
                                                               class="common-checkbox form-control<?php echo e(@$errors->has('shift') ? ' is-invalid' : ''); ?>"
                                                               name="shift[]"
                                                               value="<?php echo e(@$shift->id); ?>" <?php echo e(in_array(@$shift->id, @$shiftId)? 'checked': ''); ?>>
                                                        <label for="shift<?php echo e(@$shift->id); ?>"> <?php echo e(@$shift->shift_name); ?></label>
                                                    <?php else: ?>
                                                        <input type="checkbox" id="shift<?php echo e(@$shift->id); ?>"
                                                               class="common-checkbox form-control<?php echo e(@$errors->has('shift') ? ' is-invalid' : ''); ?>"
                                                               name="shift[]" value="<?php echo e(@$shift->id); ?>">
                                                        <label for="shift<?php echo e(@$shift->id); ?>"> <?php echo e(@$shift->shift_name); ?></label>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($errors->has('shift')): ?>
                                                <span class="text-danger" role="alert">
                                                <?php echo e(@$errors->first('shift')); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label" for=""><?php echo app('translator')->get('common.section'); ?><span
                                                    class="text-danger"> *</span></label>
                                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="">
                                                    <?php if(isset($sectionId)): ?>
                                                        <input type="checkbox" id="section<?php echo e(@$section->id); ?>"
                                                            class="common-checkbox form-control<?php echo e(@$errors->has('section') ? ' is-invalid' : ''); ?>"
                                                            name="section[]" value="<?php echo e(@$section->id); ?>"
                                                            <?php echo e(in_array(@$section->id, @$sectionId) ? 'checked' : ''); ?>>
                                                        <label for="section<?php echo e(@$section->id); ?>">
                                                            <?php echo e(@$section->section_name); ?></label>
                                                    <?php else: ?>
                                                        <input type="checkbox" id="section<?php echo e(@$section->id); ?>"
                                                            class="common-checkbox form-control<?php echo e(@$errors->has('section') ? ' is-invalid' : ''); ?>"
                                                            name="section[]" value="<?php echo e(@$section->id); ?>">
                                                        <label for="section<?php echo e(@$section->id); ?>">
                                                            <?php echo e(@$section->section_name); ?></label>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($errors->has('section')): ?>
                                                <span class="text-danger" role="alert">
                                                    <?php echo e(@$errors->first('section')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                        $tooltip = '';
                                        if (userPermission('class_store')) {
                                            $tooltip = '';
                                        } else {
                                            $tooltip = 'You have no permission to add';
                                        }
                                    ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip"
                                                title="<?php echo e($tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($sectionId)): ?>
                                                    <?php echo app('translator')->get('academics.update_class'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('academics.save_class'); ?>
                                                <?php endif; ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(html()->form()->close()); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="<?php if(userPermission('class_store') || isset($sectionId)): ?> col-lg-9 <?php else: ?> col-lg-12 <?php endif; ?>">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-4 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-15"><?php echo app('translator')->get('academics.class_list'); ?></h3>
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
                                    <table id="table_id" class="table Crm_table_active3" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>
                                                <th><?php echo app('translator')->get('common.class'); ?></th>
                                                <th>Boards</th>
                                                <th><?php echo app('translator')->get('common.section'); ?></th>
                                                <?php if(@generalSetting()->result_type == 'mark'): ?>
                                                    <th><?php echo app('translator')->get('exam.pass_mark'); ?></th>
                                                <?php endif; ?>
                                                <th><?php echo app('translator')->get('student.students'); ?></th>
                                                <th><?php echo app('translator')->get('common.action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $shift_wise_class_section = $class->groupclassSections->groupBy('shift_id');
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo e(@$class->class_name); ?></td>
                                                    <td><?php echo e(@$class->board_name ?? '-'); ?></td>
                                                    <td>
                                                        <?php if(shiftEnable()): ?>
                                                            <?php if(!empty($shift_wise_class_section)): ?>
                                                                <?php $__currentLoopData = $shift_wise_class_section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shiftId => $sectionsInShift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $shiftName = optional($sectionsInShift->first()->shift)->shift_name;
                                                                    ?>
                                                                    <?php if($shiftName): ?>
                                                                        <?php echo e($shiftName); ?>:
                                                                    <?php endif; ?>
                                                                    <?php echo $sectionsInShift->filter(function($section) {
                                                                        return optional($section->sectionName)->id !== null;
                                                                    })->map(function($section) use ($class, $shiftId) {
                                                                        $sectionId = $section->sectionName->id;
                                                                        $sectionName = $section->sectionName->section_name;
                                                                        $count = total_no_records($class->id, $sectionId, $shiftId);
                                                                        $url = route('sorting_student_list_section', [$class->id, $sectionId, $shiftId]);

                                                                        return "<a href='{$url}'>{$sectionName} ({$count})</a>";
                                                                    })->implode(', '); ?><br>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if(!empty($class->groupclassSections)): ?>
                                                                <?php echo $class->groupclassSections->filter(function($section) {
                                                                    return optional($section->sectionName)->id !== null;
                                                                })->map(function($section) use ($class) {
                                                                    $sectionId = $section->sectionName->id;
                                                                    $sectionName = $section->sectionName->section_name;
                                                                    $count = total_no_records($class->id, $sectionId);
                                                                    $url = route('sorting_student_list_section', [$class->id, $sectionId]);

                                                                    return "<a href='{$url}'>{$sectionName} ({$count})</a>";
                                                                })->implode(', '); ?>

                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if(@generalSetting()->result_type == 'mark'): ?>
                                                        <td>
                                                            <?php echo e($class->pass_mark); ?>

                                                        </td>
                                                    <?php endif; ?>
                                                    <td>
                                                        <a
                                                            href="<?php echo e(route('sorting_student_list', [$class->id])); ?>"><?php echo e($class->records_count); ?></a>
                                                    </td>


                                                    <td valign="top">
                                                        <?php
                                                            $routeList = [
                                                                userPermission('class_edit')
                                                                    ? '<a class="dropdown-item"
                                                                href="' .
                                                                        route('class_edit', [@$class->id]) .
                                                                        '">' .
                                                                        __('common.edit') .
                                                                        '</a>'
                                                                    : null,

                                                                userPermission('class_delete')
                                                                    ? '<a class="dropdown-item" data-toggle="modal"
                                                                data-target="#deleteClassModal' .
                                                                        $class->id .
                                                                        '"
                                                                href="' .
                                                                        route('class_delete', [@$class->id]) .
                                                                        '">' .
                                                                        __('common.delete') .
                                                                        '</a>'
                                                                    : null,
                                                            ];
                                                        ?>
                                                        <?php if (isset($component)) { $__componentOriginal13b64aae043a41ed039098cb8f7bff7d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13b64aae043a41ed039098cb8f7bff7d = $attributes; } ?>
<?php $component = App\View\Components\DropDownActionComponent::resolve(['routeList' => $routeList] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('drop-down-action-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DropDownActionComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13b64aae043a41ed039098cb8f7bff7d)): ?>
<?php $attributes = $__attributesOriginal13b64aae043a41ed039098cb8f7bff7d; ?>
<?php unset($__attributesOriginal13b64aae043a41ed039098cb8f7bff7d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13b64aae043a41ed039098cb8f7bff7d)): ?>
<?php $component = $__componentOriginal13b64aae043a41ed039098cb8f7bff7d; ?>
<?php unset($__componentOriginal13b64aae043a41ed039098cb8f7bff7d); ?>
<?php endif; ?>
                                                    </td>
                                                </tr>

                                                <div class="modal fade admin-query"
                                                    id="deleteClassModal<?php echo e(@$class->id); ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><?php echo app('translator')->get('academics.delete_class'); ?></h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="text-center">
                                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                                </div>

                                                                <div class="mt-40 d-flex justify-content-between">
                                                                    <button type="button" class="primary-btn tr-bg"
                                                                        data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                                    <a href="<?php echo e(route('class_delete', [$class->id])); ?>"
                                                                        class="text-light">
                                                                        <button class="primary-btn fix-gr-bg"
                                                                            type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
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

<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\resources\views/backEnd/academics/class.blade.php ENDPATH**/ ?>