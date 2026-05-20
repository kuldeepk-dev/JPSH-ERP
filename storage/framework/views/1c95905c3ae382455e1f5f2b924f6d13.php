
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('common.academic_year'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-20">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('common.academic_year'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('system_settings.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('common.academic_year'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($academic_year)): ?>
                <?php if(userPermission('academic-year-store')): ?>
                    <div class="row">
                        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                            <a href="<?php echo e(route('academic-year')); ?>" class="primary-btn small fix-gr-bg">
                                <span class="ti-plus pr-2"></span>
                                <?php echo app('translator')->get('common.add'); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($academic_year)): ?>
                            <?php echo e(html()->form('PUT', route('academic-year-update', @$academic_year->id))->attributes([
                                'class' => 'form-horizontal',
                                'files' => true,
                                'enctype' => 'multipart/form-data',
                            ])->open()); ?>

                            <?php else: ?>
                                <?php if(userPermission('academic-year-store')): ?>
                                <?php echo e(html()->form('POST', route('academic-years'))->attributes([
                                        'class' => 'form-horizontal',
                                        'files' => true,
                                        'enctype' => 'multipart/form-data',
                                    ])->open()); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="main-title">
                                    <h3 class="mb-15">
                                        <?php if(isset($academic_year)): ?>
                                            <?php echo app('translator')->get('system_settings.edit_academic_year'); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->get('system_settings.add_academic_year'); ?>
                                        <?php endif; ?>
                                    </h3>
                                </div>
                                <div class="add-visitor">
                                    <?php
                                        $yearOptions = range(1990, 2200);
                                        $selectedYear = isset($academic_year) ? (int) $academic_year->year : (int) old('year');
                                        $selectedTitle = isset($academic_year) ? (int) $academic_year->title : (int) old('title');
                                    ?>
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for="year"><?php echo app('translator')->get('common.year'); ?>
                                                    <span class="text-danger"> *</span></label>
                                                <select id="year" name="year"
                                                    class="primary_input_field form-control<?php echo e($errors->has('year') ? ' is-invalid' : ''); ?>">
                                                    <option value=""><?php echo app('translator')->get('common.select'); ?></option>
                                                    <?php $__currentLoopData = $yearOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yearOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($yearOption); ?>" <?php if($yearOption === $selectedYear): ?> selected <?php endif; ?>>
                                                            <?php echo e($yearOption); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <input type="hidden" name="id"
                                                    value="<?php echo e(isset($academic_year) ? @$academic_year->id : ''); ?>">
                                                <?php if($errors->has('year')): ?>
                                                    <span class="text-danger"><?php echo e($errors->first('year')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-end justify-content-center">
                                            <div class="primary_input_label mb-2">TO</div>
                                        </div>
                                        <div class="col-5">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for="title"><?php echo app('translator')->get('common.year'); ?>
                                                    <span class="text-danger"> *</span></label>
                                                <select id="title" name="title"
                                                    class="primary_input_field form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>">
                                                    <option value=""><?php echo app('translator')->get('common.select'); ?></option>
                                                    <?php $__currentLoopData = $yearOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yearOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($yearOption); ?>" <?php if($yearOption === $selectedTitle): ?> selected <?php endif; ?>>
                                                            <?php echo e($yearOption); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <input type="hidden" name="id"
                                                    value="<?php echo e(isset($academic_year) ? @$academic_year->id : ''); ?>">
                                                <?php if($errors->has('title')): ?>
                                                    <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                        if (isset($academic_year)) {
                                            $copy_with_academic_year = explode(',', @$academic_year->copy_with_academic_year);
                                        }
                                    ?>
                                    <div class="row mt-15">
                                        <div class="col-lg-12">
                                            <div class="primary_input">

                                                <label class="primary_input_label"
                                                    for=""><?php echo app('translator')->get('system_settings.copy_with_academic_year'); ?></label>
                                                <select multiple name="copy_with_academic_year[]" <?php echo e(isset($academic_year) ? 'disabled':''); ?>  class="multypol_check_select active position-relative">
                                                    <option value="App\SmClass"
                                                        <?php if(isset($academic_year)): ?> <?php if(in_array('App\SmClass', @$copy_with_academic_year)): ?> selected <?php endif; ?>
                                                        <?php endif; ?> ><?php echo app('translator')->get('common.class'); ?> </option>
                                                    <option value="App\SmSection"
                                                        <?php if(isset($academic_year)): ?> <?php if(in_array('App\SmSection', @$copy_with_academic_year)): ?> selected <?php endif; ?>
                                                        <?php endif; ?> ><?php echo app('translator')->get('common.section'); ?></option>
                                                    <option value="App\SmSubject"
                                                        <?php if(isset($academic_year)): ?> <?php if(in_array('App\SmSubject', @$copy_with_academic_year)): ?> selected <?php endif; ?>
                                                        <?php endif; ?> ><?php echo app('translator')->get('common.subject'); ?></option>
                                                    <option value="App\SmExamType"
                                                        <?php if(isset($academic_year)): ?> <?php if(in_array('App\SmExamType', @$copy_with_academic_year)): ?> selected <?php endif; ?>
                                                        <?php endif; ?> ><?php echo app('translator')->get('exam.exam_type'); ?> </option>
                                                    <option value="App\SmStudentCategory"
                                                        <?php if(isset($academic_year)): ?> <?php if(in_array('App\SmStudentCategory', @$copy_with_academic_year)): ?> selected <?php endif; ?>
                                                        <?php endif; ?> ><?php echo app('translator')->get('student.student_category'); ?></option>
                                                    <option value="App\SmFeesGroup"
                                                        <?php if(isset($academic_year)): ?> <?php if(in_array('App\SmFeesGroup', @$copy_with_academic_year)): ?> selected <?php endif; ?>
                                                        <?php endif; ?> ><?php echo app('translator')->get('fees.fees_group'); ?></option>
                                                    <option value="App\SmLeaveType"
                                                        <?php if(isset($academic_year)): ?> <?php if(in_array('App\SmLeaveType', @$copy_with_academic_year)): ?> selected <?php endif; ?>
                                                        <?php endif; ?> ><?php echo app('translator')->get('leave.leave_type'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        $tooltip = '';
                                        if (userPermission('academic-year-store')) {
                                            $tooltip = '';
                                        } else {
                                            $tooltip = 'You have no permission to add';
                                        }
                                    ?>
                                    <div class="row mt-15">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip"
                                                title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($academic_year)): ?>
                                                    <?php echo app('translator')->get('common.update'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('common.save'); ?>
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

                <div class="col-lg-9">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-4 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-15"> <?php echo app('translator')->get('system_settings.academic_year_list'); ?></h3>
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
                                    <table id="table_id" class="table" cellspacing="0" width="100%">
    
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('common.year'); ?></th>
                                                <th><?php echo app('translator')->get('common.year'); ?></th>
                                                <!-- <th><?php echo app('translator')->get('system_settings.starting_date'); ?></th>
                                                <th><?php echo app('translator')->get('system_settings.ending_date'); ?></th> -->
                                                <th><?php echo app('translator')->get('common.action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(@$academic_year->year); ?></td>
                                                    <td><?php echo e(@$academic_year->title); ?></td>
                                                    <!-- <td data-sort="<?php echo e(strtotime(@$academic_year->starting_date)); ?>">
                                                        <?php echo e(@$academic_year->starting_date != '' ? dateConvert(@$academic_year->starting_date) : ''); ?>

    
                                                    </td>
                                                    <td data-sort="<?php echo e(strtotime(@$academic_year->ending_date)); ?>">
                                                        <?php echo e(@$academic_year->ending_date != '' ? dateConvert(@$academic_year->ending_date) : ''); ?>

    
                                                    </td> -->
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
                                                            <?php if(userPermission('academic-year-edit')): ?>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('academic-year-edit', [@$academic_year->id])); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                            <?php endif; ?>
                                                            <?php if(userPermission('academic-year-delete')): ?>
                                                                <a class="dropdown-item" data-toggle="modal"
                                                                    data-target="#deleteAcademicYearModal<?php echo e(@$academic_year->id); ?>"
                                                                    href="#"><?php echo app('translator')->get('common.delete'); ?></a>
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
                                                </tr>
                                                <div class="modal fade admin-query"
                                                    id="deleteAcademicYearModal<?php echo e(@$academic_year->id); ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><?php echo app('translator')->get('system_settings.delete_academic_year'); ?></h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center">
                                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                                    <h5 class="text-danger">( <?php echo app('translator')->get('system_settings.academic_year_delete_confirmation'); ?> )</h5>
                                                                </div>
    
                                                                <div class="mt-40 d-flex justify-content-between">
                                                                    <button type="button" class="primary-btn tr-bg"
                                                                        data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
    
                                                                        <?php echo e(html()->form('DELETE', route('academic-year-delete', @$academic_year->id))->attribute('enctype', 'multipart/form-data')->open()); ?>

                                                                    <button class="primary-btn fix-gr-bg"
                                                                        type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
    
                                                                    <?php echo html()->form()->close(); ?>

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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.partials.multi_select_js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('backEnd.partials.data_table_js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('backEnd.partials.date_picker_css_js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\resources\views/backEnd/systemSettings/academic_year.blade.php ENDPATH**/ ?>