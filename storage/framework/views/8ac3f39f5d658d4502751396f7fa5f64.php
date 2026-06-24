<?php $__env->startPush('css'); ?>
    <style>
        @media (max-width: 767px) {
            .dataTables_filter label {
                top: -25px !important;
                width: 100%;
            }
        }

        @media screen and (max-width: 640px) {
            div.dt-buttons {
                display: none;
            }

            .dataTables_filter label {
                top: -60px !important;
                width: 100%;
                float: right;
            }

            /* .main-title{
            margin-bottom: 40px
        } */
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('academics.assign_subject'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-20">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('academics.assign_subject'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('academics.academics'); ?></a>
                    <a href="#"><?php echo app('translator')->get('academics.assign_subject'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <div id="ajaxSpinnerContainer">
        
    </div>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="main-title">
                                    <h3 class="mb-15 "><?php echo app('translator')->get('common.select_criteria'); ?></h3>
                                </div>
                            </div>
                            <?php if(userPermission('assign-subject-store')): ?>
                                <div class="col-lg-6 text-left text-sm-right col-md-6 col-sm-6">
                                    <a href="<?php echo e(route('assign_subject_create')); ?>" class="primary-btn small fix-gr-bg">
                                        <span class="ti-plus pr-2"></span>
                                        <?php echo app('translator')->get('academics.assign_subject'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php echo e(html()->form('POST', route('assign-subject'))->attribute('class', 'form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('files', true)->attribute('id', 'search_student')->open()); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <?php if(moduleStatusCheck('University')): ?>
                            <?php if ($__env->exists(
                                    'university::common.session_faculty_depart_academic_semester_level',
                                    [
                                        'required' => ['USN', 'UD', 'UA', 'US', 'USL'],
                                        'div' => 'col-lg-3',
                                        'hide' => ['USUB'],
                                    ]
                                )) echo $__env->make(
                                    'university::common.session_faculty_depart_academic_semester_level',
                                    [
                                        'required' => ['USN', 'UD', 'UA', 'US', 'USL'],
                                        'div' => 'col-lg-3',
                                        'hide' => ['USUB'],
                                    ]
                                , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php else: ?>    
                                <?php echo $__env->make('backEnd.shift.shift_class_section_include', [
                                    'div' => shiftEnable() ? 'col-lg-4' : 'col-lg-6',
                                    'visiable' => ['shift', 'class', 'section'],
                                    'required' => ['class', 'section'],
                                    'class_name' => 'class',
                                    'section_name' => 'section',
                                    'title' => [],
                                    'selected' => [
                                        'shift_id' => @$shift_id,
                                        'class_id' => @$class_id,
                                        'section_id' => @$section_id,
                                    ],
                                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    <?php echo app('translator')->get('common.search'); ?>
                                </button>
                            </div>
                        </div>
                        <?php echo e(html()->form()->close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(isset($assign_subjects) && $assign_subjects->count() > 0): ?>
        <section class="admin-visitor-area">
            <div class="container-fluid p-0">
                <div class="white-box mt-40">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="main-title">
                                <h3 class="mb-15"><?php echo app('translator')->get('academics.assign_subject'); ?> </h3>
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
                                            <th><?php echo app('translator')->get('academics.subject'); ?></th>
                                            <th><?php echo app('translator')->get('common.teacher'); ?></th>
                                            <?php if(@generalSetting()->result_type == 'mark'): ?>
                                                <th><?php echo app('translator')->get('academics.pass_mark'); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 4; ?>
                                        <?php $__currentLoopData = $assign_subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assign_subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(@$assign_subject->subject != '' ? @$assign_subject->subject->subject_name : ''); ?>

                                                </td>
                                                <td>
                                                    <?php if(@$assign_subject->teacher != ''): ?>
                                                        <?php echo e(@$assign_subject->teacher->full_name); ?>

                                                    <?php else: ?>
                                                        <?php echo app('translator')->get('academics.not_assigned_yet'); ?>
                                                    <?php endif; ?>
                                                </td>
                                                <?php if(@generalSetting()->result_type == 'mark'): ?>
                                                    <td><?php echo e(@$assign_subject->pass_mark); ?></td>
                                                <?php endif; ?>
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
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.partials.data_table_js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\resources\views/backEnd/academics/assign_subject.blade.php ENDPATH**/ ?>