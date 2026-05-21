
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('student.student_admission'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .admission-wizard {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 24px;
        }

        .admission-stepper {
            position: sticky;
            top: 90px;
            align-self: start;
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
        }

        .admission-stepper h4 {
            margin-bottom: 16px;
        }

        .admission-progress {
            height: 6px;
            background: #e9edf1;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .admission-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #1a73e8, #00bcd4);
            width: 0;
            transition: width 0.3s ease;
        }

        .step-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .step-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            color: #6b7280;
            font-size: 13px;
        }

        .step-list li.active {
            color: #111827;
            font-weight: 600;
        }

        .step-index {
            height: 26px;
            width: 26px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #111827;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .step-list li.active .step-index {
            background: #1a73e8;
            color: #ffffff;
        }

        .admission-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .admission-card h4 {
            margin-bottom: 16px;
            font-size: 16px;
        }

        .admission-step {
            display: none;
        }

        .admission-step.active {
            display: block;
        }

        .admission-actions {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 20px;
        }

        .required-star {
            color: #e11d48;
            margin-left: 2px;
        }

        .input-error {
            border-color: #e11d48 !important;
        }

        .error-text {
            color: #e11d48;
            font-size: 12px;
            margin-top: 4px;
        }

        .file-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .file-preview-item {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 12px;
            background: #f9fafb;
        }

        @media (max-width: 992px) {
            .admission-wizard {
                grid-template-columns: 1fr;
            }

            .admission-stepper {
                position: static;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-20 up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('student.student_admission'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('student.student_information'); ?></a>
                    <a href="#"><?php echo app('translator')->get('student.student_admission'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php echo e(html()->form('POST', route('student_store'))->attributes([
                'class' => 'form-horizontal studentadmission',
                'enctype' => 'multipart/form-data',
                'files' => true,
                'id' => 'student_admission_form',
            ])->open()); ?>

            <?php echo csrf_field(); ?>
            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

            <div class="admission-wizard">
                <div class="admission-stepper">
                    <h4>Admission Progress</h4>
                    <div class="admission-progress">
                        <div class="admission-progress-bar" id="admission_progress_bar"></div>
                    </div>
                    <ul class="step-list" id="admission_step_list">
                        <li class="active" data-step="1"><span class="step-index">1</span> Student Information</li>
                        <li data-step="2"><span class="step-index">2</span> Residential Address</li>
                        <li data-step="3"><span class="step-index">3</span> Parent Details</li>
                        <li data-step="4"><span class="step-index">4</span> Family &amp; Additional Info</li>
                        <li data-step="5"><span class="step-index">5</span> Last School Attended</li>
                        <li data-step="6"><span class="step-index">6</span> Achievements</li>
                        <li data-step="7"><span class="step-index">7</span> Transport &amp; Voluntary Services</li>
                        <li data-step="8"><span class="step-index">8</span> Documents Upload</li>
                        <li data-step="9"><span class="step-index">9</span> Declaration &amp; Consent</li>
                    </ul>
                </div>

                <div>
                    <div class="admission-step active" data-step="1">
                        <div class="admission-card">
                            <h4>Student Information</h4>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Academic Year<span class="required-star">*</span></label>
                                    <select class="primary_select form-control" name="session" id="academic_year" required>
                                        <option value="">Select Academic Year</option>
                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($session->id); ?>" <?php echo e(old('session', getAcademicId()) == $session->id ? 'selected' : ''); ?>>
                                                <?php echo e($session->year); ?>-<?php echo e($session->title); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Board<span class="required-star">*</span></label>
                                    <select class="primary_select form-control" id="admission_board_id" name="board_id" required>
                                        <option value="">Select Board</option>
                                        <?php $__currentLoopData = generalBoards(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($board); ?>" <?php echo e(old('board_id', selectedBoard()) === $board ? 'selected' : ''); ?>>
                                                <?php echo e($board); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Applying For Class<span class="required-star">*</span></label>
                                    <select class="primary_select form-control" name="class" id="admission_class_id" required>
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Section<span class="required-star">*</span></label>
                                    <select class="primary_select form-control" name="section" id="admission_section_id" required>
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Admission Number<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="admission_number" value="<?php echo e($max_admission_id != '' ? $max_admission_id + 1 : 1); ?>" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Roll Number</label>
                                    <input class="primary_input_field form-control" name="roll_number" value="<?php echo e(old('roll_number')); ?>">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Admission Date<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" type="date" name="admission_date" value="<?php echo e(old('admission_date', date('Y-m-d'))); ?>" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Student First Name<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Student Last Name<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Email</label>
                                    <input class="primary_input_field form-control" name="email_address" value="<?php echo e(old('email_address')); ?>">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Gender<span class="required-star">*</span></label>
                                    <select class="primary_select form-control" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gender->id); ?>"><?php echo e($gender->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Date of Birth<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" type="date" name="date_of_birth" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Aadhaar Number</label>
                                    <input class="primary_input_field form-control" name="aadhaar_number">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Age</label>
                                    <input class="primary_input_field form-control" name="age">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Place of Birth</label>
                                    <input class="primary_input_field form-control" name="place_of_birth">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Nationality</label>
                                    <input class="primary_input_field form-control" name="nationality">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Religion</label>
                                    <select class="primary_select form-control" name="religion">
                                        <option value="">Select Religion</option>
                                        <?php $__currentLoopData = $religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $religion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($religion->id); ?>"><?php echo e($religion->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Mother Tongue</label>
                                    <input class="primary_input_field form-control" name="mother_tongue">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Blood Group</label>
                                    <select class="primary_select form-control" name="blood_group">
                                        <option value="">Select Blood Group</option>
                                        <?php $__currentLoopData = $blood_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blood): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($blood->id); ?>"><?php echo e($blood->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Category</label>
                                    <select class="primary_select form-control" name="caste">
                                        <option value="">Select Category</option>
                                        <option value="General">General</option>
                                        <option value="SC">SC</option>
                                        <option value="ST">ST</option>
                                        <option value="OBC">OBC</option>
                                        <option value="SBC">SBC</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Student Category</label>
                                    <select class="primary_select form-control" name="student_category_id">
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Student Group</label>
                                    <select class="primary_select form-control" name="student_group_id">
                                        <option value="">Select Group</option>
                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($group->id); ?>"><?php echo e($group->group); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Previous Language Studied</label>
                                    <input class="primary_input_field form-control" name="previous_language">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Languages Spoken at Home</label>
                                    <input class="primary_input_field form-control" name="home_languages">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="2">
                        <div class="admission-card">
                            <h4>Residential Address</h4>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">Address<span class="required-star">*</span></label>
                                    <textarea class="primary_input_field form-control" name="current_address" rows="3" required></textarea>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">City</label>
                                    <input class="primary_input_field form-control" name="city">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">State</label>
                                    <input class="primary_input_field form-control" name="state">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Country</label>
                                    <input class="primary_input_field form-control" name="country">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Pin Code</label>
                                    <input class="primary_input_field form-control" name="pin_code">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Residence Phone</label>
                                    <input class="primary_input_field form-control" name="residence_phone">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Mobile Number<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="phone_number" required>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">Permanent Address</label>
                                    <textarea class="primary_input_field form-control" name="permanent_address" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="3">
                        <div class="admission-card">
                            <h4>Father Details</h4>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Name<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="fathers_name" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Qualification</label>
                                    <input class="primary_input_field form-control" name="father_qualification">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Occupation<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="fathers_occupation" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Organization &amp; Designation</label>
                                    <input class="primary_input_field form-control" name="father_organization">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Mobile<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="fathers_phone" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Email</label>
                                    <input class="primary_input_field form-control" name="fathers_email">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Aadhaar Number</label>
                                    <input class="primary_input_field form-control" name="fathers_aadhaar">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Annual Income</label>
                                    <input class="primary_input_field form-control" name="fathers_income">
                                </div>
                            </div>
                        </div>
                        <div class="admission-card">
                            <h4>Mother Details</h4>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Name<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="mothers_name" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Qualification</label>
                                    <input class="primary_input_field form-control" name="mother_qualification">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Occupation<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="mothers_occupation" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Organization &amp; Designation</label>
                                    <input class="primary_input_field form-control" name="mother_organization">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Mobile<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="mothers_phone" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Email</label>
                                    <input class="primary_input_field form-control" name="mothers_email">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Aadhaar Number</label>
                                    <input class="primary_input_field form-control" name="mothers_aadhaar">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Annual Income</label>
                                    <input class="primary_input_field form-control" name="mothers_income">
                                </div>
                            </div>
                        </div>
                        <div class="admission-card">
                            <h4>Guardian Details</h4>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Guardian Name<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="guardians_name" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Relation with Candidate<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="relation" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Qualification</label>
                                    <input class="primary_input_field form-control" name="guardian_qualification">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Occupation<span class="required-star">*</span></label>
                                    <input class="primary_input_field form-control" name="guardians_occupation" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Organization &amp; Designation</label>
                                    <input class="primary_input_field form-control" name="guardian_organization">
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">Address<span class="required-star">*</span></label>
                                    <textarea class="primary_input_field form-control" name="guardians_address" rows="2" required></textarea>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Mobile</label>
                                    <input class="primary_input_field form-control" name="guardians_phone">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Email</label>
                                    <input class="primary_input_field form-control" name="guardians_email">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Aadhaar Number</label>
                                    <input class="primary_input_field form-control" name="guardians_aadhaar">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="4">
                        <div class="admission-card">
                            <h4>Sibling Details</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Class</th>
                                                <th>Age</th>
                                                <th>School</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input class="form-control" name="siblings[0][name]"></td>
                                                <td><input class="form-control" name="siblings[0][class]"></td>
                                                <td><input class="form-control" name="siblings[0][age]"></td>
                                                <td><input class="form-control" name="siblings[0][school]"></td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control" name="siblings[1][name]"></td>
                                                <td><input class="form-control" name="siblings[1][class]"></td>
                                                <td><input class="form-control" name="siblings[1][age]"></td>
                                                <td><input class="form-control" name="siblings[1][school]"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label class="primary_input_label">Single Girl Child</label>
                                    <select class="primary_select form-control" name="single_girl_child">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label class="primary_input_label">Specially Abled</label>
                                    <select class="primary_select form-control" name="specially_abled">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label class="primary_input_label">EWS Category</label>
                                    <select class="primary_select form-control" name="ews_category">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="5">
                        <div class="admission-card">
                            <h4>Last School Attended</h4>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">School Name</label>
                                    <input class="primary_input_field form-control" name="last_school_name">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">City/Country</label>
                                    <input class="primary_input_field form-control" name="last_school_city">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Class</label>
                                    <input class="primary_input_field form-control" name="last_school_class">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Board of Education</label>
                                    <input class="primary_input_field form-control" name="last_school_board">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="6">
                        <div class="admission-card">
                            <h4>Achievements</h4>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">Academic</label>
                                    <textarea class="primary_input_field form-control" name="achievement_academic" rows="2"></textarea>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">Sports &amp; Games</label>
                                    <textarea class="primary_input_field form-control" name="achievement_sports" rows="2"></textarea>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">Co-curricular Activities</label>
                                    <textarea class="primary_input_field form-control" name="achievement_co_curricular" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="7">
                        <div class="admission-card">
                            <h4>Transport &amp; Voluntary Services</h4>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Mode of Transport</label>
                                    <select class="primary_select form-control" name="transport_mode">
                                        <option value="">Select</option>
                                        <option value="school">School Transport</option>
                                        <option value="self">Self</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">Voluntary Contribution / Services</label>
                                    <textarea class="primary_input_field form-control" name="voluntary_services" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="8">
                        <div class="admission-card">
                            <h4>Documents Upload</h4>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Document Title 1</label>
                                    <input class="primary_input_field form-control" name="document_title_1" value="Birth Certificate">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Birth Certificate<span class="required-star">*</span></label>
                                    <input class="form-control" type="file" name="document_file_1" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <input class="form-control" type="file" name="document_birth_certificate" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Document Title 2</label>
                                    <input class="primary_input_field form-control" name="document_title_2" value="Transfer Certificate">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Transfer Certificate<span class="required-star">*</span></label>
                                    <input class="form-control" type="file" name="document_file_2" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <input class="form-control" type="file" name="document_transfer_certificate" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Passport Photos<span class="required-star">*</span></label>
                                    <input class="form-control" type="file" name="document_passport_photos" accept=".jpg,.jpeg,.png" multiple required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Document Title 3</label>
                                    <input class="primary_input_field form-control" name="document_title_3" value="Report Card">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Report Card<span class="required-star">*</span></label>
                                    <input class="form-control" type="file" name="document_file_3" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <input class="form-control" type="file" name="document_report_card" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Document Title 4</label>
                                    <input class="primary_input_field form-control" name="document_title_4" value="Category Certificate">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Category Certificate (SC/ST/OBC/SBC)</label>
                                    <input class="form-control" type="file" name="document_file_4" accept=".pdf,.jpg,.jpeg,.png">
                                    <input class="form-control" type="file" name="document_category_certificate" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Aadhaar Copies<span class="required-star">*</span></label>
                                    <input class="form-control" type="file" name="document_aadhaar" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                            </div>
                            <div class="file-preview" id="document_preview"></div>
                        </div>
                    </div>

                    <div class="admission-step" data-step="9">
                        <div class="admission-card">
                            <h4>Declaration &amp; Consent</h4>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <textarea class="primary_input_field form-control" rows="6" readonly>
Parent/Guardian declaration, fee acknowledgement, discipline and policy agreement, and consent to school rules apply as per school admission policy.
                                    </textarea>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Parent/Guardian Signature</label>
                                    <input class="primary_input_field form-control" name="parent_signature">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="primary_input_label">Date</label>
                                    <input class="primary_input_field form-control" type="date" name="consent_date">
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="primary_input_label">
                                        <input type="checkbox" name="consent_accepted" id="consent_accepted" required>
                                        I agree to the declaration and consent terms.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admission-actions">
                        <button type="button" class="primary-btn fix-gr-bg" id="prev_step">Previous</button>
                        <div class="d-flex" style="gap: 10px;">
                            <button type="button" class="primary-btn tr-bg" id="save_draft">Save Draft</button>
                            <button type="button" class="primary-btn fix-gr-bg" id="next_step">Next</button>
                            <button type="submit" class="primary-btn fix-gr-bg" id="submit_admission" style="display:none;">Submit Application</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo e(html()->form()->close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function() {
            console.log('=== ADMISSION WIZARD SCRIPT INITIALIZED ===');
            var currentStep = 1;
            var totalSteps = 9;

            function updateStepper() {
                document.querySelectorAll('.admission-step').forEach(function(step) {
                    step.classList.remove('active');
                    if (parseInt(step.dataset.step, 10) === currentStep) {
                        step.classList.add('active');
                    }
                });

                document.querySelectorAll('#admission_step_list li').forEach(function(item) {
                    item.classList.toggle('active', parseInt(item.dataset.step, 10) === currentStep);
                });

                var progress = (currentStep / totalSteps) * 100;
                document.getElementById('admission_progress_bar').style.width = progress + '%';
                document.getElementById('prev_step').style.visibility = currentStep === 1 ? 'hidden' : 'visible';
                document.getElementById('next_step').style.display = currentStep === totalSteps ? 'none' : 'inline-flex';
                document.getElementById('submit_admission').style.display = currentStep === totalSteps ? 'inline-flex' : 'none';
            }

            function validateStep() {
                var stepEl = document.querySelector('.admission-step.active');
                if (!stepEl) {
                    return true;
                }
                var valid = true;
                stepEl.querySelectorAll('[required]').forEach(function(input) {
                    if (!input.value || (input.type === 'checkbox' && !input.checked)) {
                        input.classList.add('input-error');
                        valid = false;
                    } else {
                        input.classList.remove('input-error');
                    }
                });
                return valid;
            }

            document.getElementById('next_step').addEventListener('click', function() {
                if (!validateStep()) {
                    return;
                }
                if (currentStep < totalSteps) {
                    currentStep += 1;
                    updateStepper();
                    window.scrollTo(0, 0);
                }
            });

            document.getElementById('prev_step').addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep -= 1;
                    updateStepper();
                    window.scrollTo(0, 0);
                }
            });

            document.getElementById('save_draft').addEventListener('click', function() {
                var formData = $('#student_admission_form').serialize();
                $.post('<?php echo e(route('student_admission_draft')); ?>', formData)
                    .done(function(resp) {
                        toastr.success('Draft saved: ' + resp.application_id, 'Success');
                    })
                    .fail(function() {
                        toastr.error('Draft save failed', 'Error');
                    });
            });

            var draftTimer = setInterval(function() {
                var formData = $('#student_admission_form').serialize();
                $.post('<?php echo e(route('student_admission_draft')); ?>', formData);
            }, 60000);

            function logAdmissionDebug(message, payload) {
                if (typeof payload === 'undefined') {
                    console.log('[StudentAdmissionDebug]', message);
                } else {
                    console.log('[StudentAdmissionDebug]', message, payload);
                }
            }

            function updateNiceSelect($el) {
                if ($.fn.niceSelect && $el.length) {
                    $el.niceSelect('update');
                }
            }

            function getClassSelect() {
                return $('#class').length ? $('#class') : $('#admission_class_id');
            }

            function getSectionSelect() {
                return $('#section').length ? $('#section') : $('#admission_section_id');
            }

            function resetClassDropdown() {
                var $class = getClassSelect();
                $class.empty().append('<option value="">Select Class</option>');
                $class.prop('disabled', true);
                updateNiceSelect($class);
                logAdmissionDebug('Class dropdown enabled state', !$class.prop('disabled'));
            }

            function resetSectionDropdown() {
                var $section = getSectionSelect();
                $section.empty().append('<option value="">Select Section</option>');
                $section.prop('disabled', true);
                updateNiceSelect($section);
                logAdmissionDebug('Section dropdown enabled state', !$section.prop('disabled'));
            }

            function loadClassesByBoard(board, selectedClass, selectedSection) {
                var url = $('#url').val();
                var academicId = $('#academic_year').val();
                var encodedBoard = encodeURIComponent(board);
                var apiUrl = url + '/admission/get-classes-by-board/' + encodedBoard;

                logAdmissionDebug('Class API URL', apiUrl);
                logAdmissionDebug('Class API payload', { academic_id: academicId });

                $.get(apiUrl, { academic_id: academicId })
                    .done(function(response) {
                        logAdmissionDebug('Class API response', response);
                        var classes = Array.isArray(response) ? response : (response.classes || []);
                        var $class = getClassSelect();
                        var $section = getSectionSelect();
                        logAdmissionDebug('Parsed classes', classes);

                        resetClassDropdown();
                        resetSectionDropdown();
                        if (classes.length) {
                            $class.prop('disabled', false);
                            classes.forEach(function(cls) {
                                $class.append('<option value="' + cls.id + '">' + cls.class_name + '</option>');
                            });
                        } else {
                            $class.prop('disabled', true);
                        }
                        updateNiceSelect($class);
                        logAdmissionDebug('Class dropdown enabled state', !$class.prop('disabled'));
                        logAdmissionDebug('Final class dropdown HTML', $class.html());
                        logAdmissionDebug('Class dropdown value', $class.val());

                        if (selectedClass) {
                            $class.val(selectedClass);
                            updateNiceSelect($class);
                            if ($class.val()) {
                                loadSectionsByBoardClass(board, selectedClass, selectedSection);
                            }
                        } else {
                            $section.prop('disabled', true);
                            updateNiceSelect($section);
                            logAdmissionDebug('Section dropdown enabled state', !$section.prop('disabled'));
                        }
                    })
                    .fail(function(xhr) {
                        logAdmissionDebug('Class API failed', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            responseText: xhr.responseText
                        });
                        resetClassDropdown();
                        resetSectionDropdown();
                    });
            }

            function loadSectionsByBoardClass(board, classId, selectedSection) {
                var url = $('#url').val();
                var academicId = $('#academic_year').val();
                var encodedBoard = encodeURIComponent(board);
                var apiUrl = url + '/admission/get-sections-by-board-class/' + encodedBoard + '/' + classId;

                logAdmissionDebug('Section API URL', apiUrl);
                logAdmissionDebug('Section API payload', { academic_id: academicId });

                $.get(apiUrl, { academic_id: academicId })
                    .done(function(sections) {
                        logAdmissionDebug('Section API response', sections);
                        var $section = getSectionSelect();
                        resetSectionDropdown();
                        $section.prop('disabled', false);

                        if (sections && sections.length) {
                            sections.forEach(function(section) {
                                $section.append('<option value="' + section.id + '">' + section.section_name + '</option>');
                            });
                        }

                        if (selectedSection) {
                            $section.val(selectedSection);
                        }
                        updateNiceSelect($section);
                        logAdmissionDebug('Section dropdown enabled state', !$section.prop('disabled'));
                    })
                    .fail(function(xhr) {
                        logAdmissionDebug('Section API failed', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            responseText: xhr.responseText
                        });
                        resetSectionDropdown();
                    });
            }

            $(document).on('change', '#admission_board_id', function() {
                var board = $(this).val();
                logAdmissionDebug('Board onchange fired', board);
                resetClassDropdown();
                resetSectionDropdown();
                if (!board) {
                    logAdmissionDebug('Board empty, skipping class API');
                    return;
                }
                loadClassesByBoard(board, '', '');
            });

            $(document).on('change', '#admission_class_id, #class', function() {
                var classId = $(this).val();
                var board = $('#admission_board_id').val();
                logAdmissionDebug('Class onchange fired', { board: board, class_id: classId });
                resetSectionDropdown();
                if (!board || !classId) {
                    logAdmissionDebug('Class/board missing, skipping section API', { board: board, class_id: classId });
                    return;
                }
                loadSectionsByBoardClass(board, classId, '');
            });

            $('#student_admission_form input[type="file"]').on('change', function() {
                var preview = $('#document_preview');
                preview.empty();
                $('#student_admission_form input[type="file"]').each(function() {
                    Array.from(this.files || []).forEach(function(file) {
                        preview.append('<div class="file-preview-item">' + file.name + '</div>');
                    });
                });
            });

            updateStepper();

            logAdmissionDebug('Selector check #board_id length', $('#board_id').length);
            logAdmissionDebug('Selector check [name=\"board_id\"] length', $('[name="board_id"]').length);
            logAdmissionDebug('Selector check #admission_board_id length', $('#admission_board_id').length);
            logAdmissionDebug('Selector check #class length', $('#class').length);
            logAdmissionDebug('Selector check [name=\"class\"] length', $('[name="class"]').length);
            var initialBoard = $('#admission_board_id').val();
            logAdmissionDebug('Initial board value on page load', initialBoard);
            if (initialBoard) {
                $('#admission_board_id').trigger('change');
            }
        })();
    </script>
    <?php if(!empty($draft_application)): ?>
        <script>
            (function() {
                console.log('[StudentAdmissionDebug]', '=== LOADING DRAFT APPLICATION ===');
                var draftData = <?php echo json_encode(json_decode((string) $draft_application->data_json, true) ?: [], 512) ?>;
                var skipFields = ['board_id', 'class', 'section'];
                console.log('[StudentAdmissionDebug]', 'Draft Data Loaded:', draftData);
                Object.keys(draftData || {}).forEach(function(key) {
                    var value = draftData[key];
                    console.log('[StudentAdmissionDebug]', 'Setting field:', key, 'Value:', value);
                    if (skipFields.indexOf(key) !== -1) {
                        console.log('[StudentAdmissionDebug]', 'Skipping dependent field:', key);
                        return;
                    }
                    if (value === null || typeof value === 'object') {
                        console.log('[StudentAdmissionDebug]', 'Skipping field:', key, '(null or object)');
                        return;
                    }
                    var $field = $('[name="' + key + '"]');
                    if (!$field.length) {
                        console.log('[StudentAdmissionDebug]', 'Field not found in form:', key);
                        return;
                    }
                    if ($field.is(':checkbox')) {
                        $field.prop('checked', value === true || value === '1' || value === 1);
                        console.log('[StudentAdmissionDebug]', 'Set checkbox:', key, 'checked:', $field.prop('checked'));
                    } else {
                        $field.val(value).trigger('change');
                        console.log('[StudentAdmissionDebug]', 'Set field value:', key, 'to:', value);
                    }
                });
                var draftBoard = draftData.board_id;
                var draftClass = draftData.class;
                var draftSection = draftData.section;
                var $boardField = $('#admission_board_id').length ? $('#admission_board_id') : $('[name="board_id"]');
                console.log('[StudentAdmissionDebug]', 'Board selector exists:', $boardField.length);
                if (draftBoard && $boardField.length) {
                    console.log('[StudentAdmissionDebug]', 'Triggering board change for draft board:', draftBoard);
                    $boardField.val(draftBoard);
                    if ($.fn.niceSelect) {
                        $boardField.niceSelect('update');
                    }
                    if (typeof loadClassesByBoard === 'function') {
                        loadClassesByBoard(draftBoard, draftClass, draftSection);
                    } else {
                        $boardField.trigger('change');
                    }
                }
                console.log('[StudentAdmissionDebug]', 'Draft prefill completed');
            })();
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\infixEdu_v9.0.1\resources\views/backEnd/studentInformation/student_admission_wizard.blade.php ENDPATH**/ ?>