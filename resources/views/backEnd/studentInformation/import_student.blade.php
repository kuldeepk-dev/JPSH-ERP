@extends('backEnd.master')
@section('title')
    @lang('student.student_import')
@endsection
@push('css')
    <style>
        .input-right-icon button.primary-btn-small-input {
            top: 8px !important;
            right: 11px !important;
        }
    </style>
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-20 up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('student.student_import')</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="#">@lang('student.student_admission')</a>
                    <a href="#">@lang('student.student_import')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-title">
                        <h3>@lang('common.select_criteria')</h3>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-3 text-right mb-20">
                    <a href="{{ url('/public/backEnd/bulksample/students.xlsx') }}">
                        <button class="primary-btn tr-bg text-uppercase bord-rad">
                            @lang('student.download_sample_file')
                            <span class="pl ti-download"></span>
                        </button>
                    </a>
                </div>
            </div>

            {{ html()->form('POST', route('student_bulk_store'))->attributes([
                'class' => 'form-horizontal',
                'files' => true,
                'enctype' => 'multipart/form-data',
                'id' => 'student_form',
            ])->open() }}
            <div class="row">
                <div class="col-lg-12">


                    <div class="white-box">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <div class="box-body">
                                            <br>
                                            1. @lang('student.point1')<br>
                                            2. @lang('student.point2')<br>
                                            3. @lang('student.point3')<br>
                                            4. @lang('student.point4')<br>

                                            5. @lang('student.point6')(
                                            @foreach ($genders as $gender)
                                                {{ $gender->id . '=' . $gender->base_setup_name . ',' }}
                                            @endforeach


                                            ).<br>
                                            6. @lang('student.point7')(
                                            @foreach ($blood_groups as $blood_group)
                                                {{ $blood_group->id . '=' . $blood_group->base_setup_name . ',' }}
                                            @endforeach
                                            ).<br>
                                            7. @lang('student.point8')(
                                            @foreach ($religions as $religion)
                                                {{ $religion->id . '=' . $religion->base_setup_name . ',' }}
                                            @endforeach
                                            ).<br>
                                            8. For relation with guardian (F=Father, M=Mother, O=Other)<br>
                                            9. Please follow this date format(2020-06-15) for Date of birth & Admission
                                            date<br>
                                            10. For mixed import, add Excel columns: <b>board</b>, <b>class</b>,
                                            <b>section</b> (value can be ID or exact name).<br>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
                            <div class="row mb-40 mt-30">

                                @if (moduleStatusCheck('University'))
                                    @includeIf(
                                        'university::common.session_faculty_depart_academic_semester_level',
                                        [
                                            'hide' => ['USUB'],
                                            'required' => ['US', 'UD', 'USN', 'USL', 'UA', 'USEC'],
                                        ]
                                    )
                                    <div class="col-lg-3 mt-25">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="primary_input">
                                                    <input
                                                        class="primary_input_field form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                                        type="text" id="placeholderPhoto" placeholder="Excel file"
                                                        readonly>

                                                    @if ($errors->has('file'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('file') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                        for="photo">@lang('common.browse')</label>
                                                    <input type="file" class="d-none" name="file" id="photo">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-3">
                                        <div class="primary_input ">
                                            <select
                                                class="primary_select  form-control{{ $errors->has('session') ? ' is-invalid' : '' }}"
                                                name="session" id="academic_year">
                                                <option data-display="@lang('common.academic_year') *" value="">
                                                    @lang('common.academic_year') *</option>
                                                @foreach ($sessions as $session)
                                                    <option value="{{ $session->id }}"
                                                        {{ old('session') == $session->id ? 'selected' : '' }}>
                                                        {{ $session->year }}[{{ $session->title }}]</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('session'))
                                                <span class="text-danger invalid-select" role="alert">
                                                    {{ $errors->first('session') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="primary_input ">
                                            <select
                                                class="primary_select form-control{{ $errors->has('board_id') ? ' is-invalid' : '' }}"
                                                name="board_id" id="import_board_id">
                                                <option data-display="@lang('common.select_board')" value="">
                                                    @lang('common.select_board')</option>
                                                @foreach (generalBoards() as $board)
                                                    <option value="{{ $board }}"
                                                        {{ old('board_id', selectedBoard()) === $board ? 'selected' : '' }}>
                                                        {{ $board }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('board_id'))
                                                <span class="text-danger invalid-select" role="alert">
                                                    {{ $errors->first('board_id') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="primary_input" id="class-div">
                                            <select
                                                class="primary_select  form-control{{ $errors->has('class') ? ' is-invalid' : '' }}"
                                                name="class" id="classSelectStudent">
                                                <option data-display="@lang('common.class')" value="">
                                                    @lang('common.class')</option>
                                            </select>
                                            <div class="pull-right loader loader_style" id="select_class_loader">
                                                <img class="loader_img_style"
                                                    src="{{ asset('public/backEnd/img/demo_wait.gif') }}" alt="loader">
                                            </div>

                                            @if ($errors->has('class'))
                                                <span class="text-danger invalid-select" role="alert">
                                                    {{ $errors->first('class') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="primary_input" id="sectionStudentDiv">
                                            <select
                                                class="primary_select  form-control{{ $errors->has('section') ? ' is-invalid' : '' }}"
                                                name="section" id="sectionSelectStudent">
                                                <option data-display="@lang('common.section')" value="">
                                                    @lang('common.section')</option>
                                            </select>
                                            <div class="pull-right loader loader_style" id="select_section_loader">
                                                <img class="loader_img_style"
                                                    src="{{ asset('public/backEnd/img/demo_wait.gif') }}" alt="loader">
                                            </div>

                                            @if ($errors->has('section'))
                                                <span class="text-danger invalid-select" role="alert">
                                                    {{ $errors->first('section') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                       
                                        <div class="primary_input">                                           
                                            <div class="primary_file_uploader">
                                                <input
                                                        class="primary_input_field form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                                        type="text" id="placeholderPhoto" placeholder="Excel file"
                                                        readonly>
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="upload_content_file"><span
                                                            class="ripple rippleEffect"
                                                            style="width: 56.8125px; height: 56.8125px; top: -16.4062px; left: 10.4219px;"></span>@lang('common.browse')</label>
                                                    <input type="file" class="d-none" name="file"
                                                        id="upload_content_file">
                                                </button>
                                            </div>
                                          
                                            @if ($errors->has('file'))
                                            <span class="text-danger d-block">
                                                {{ $errors->first('file') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif


                            </div>

                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        @lang('student.save_bulk_students')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </section>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            const oldClassId = "{{ old('class') }}";
            const oldSectionId = "{{ old('section') }}";
            const bulkDebugPrefix = "[BulkImport]";
            const logBulk = function(message, payload) {
                if (typeof payload === 'undefined') {
                    console.log(bulkDebugPrefix, message);
                    return;
                }
                console.log(bulkDebugPrefix, message, payload);
            };

            function resetClassDropdown() {
                $('#classSelectStudent')
                    .empty()
                    .append($('<option>', {
                        value: '',
                        text: "{{ __('student.select_class') }}"
                    }))
                    .prop('disabled', true);
                $('#classSelectStudent').niceSelect('update');
            }

            function resetSectionDropdown() {
                $('#sectionSelectStudent')
                    .empty()
                    .append($('<option>', {
                        value: '',
                        text: "{{ __('student.select_section') }}"
                    }))
                    .prop('disabled', true);
                $('#sectionSelectStudent').niceSelect('update');
            }

            function loadClassesByBoard(boardId, selectedClassId = '', selectedSectionId = '') {
                const baseUrl = $('#url').val();
                logBulk("Loading classes", {
                    board_id: boardId,
                    academic_id: $('#academic_year').val()
                });
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        academic_id: $('#academic_year').val()
                    },
                    url: baseUrl + '/admission/get-classes-by-board/' + encodeURIComponent(boardId),
                    success: function(classes) {
                        logBulk("Classes loaded", classes);
                        resetClassDropdown();
                        resetSectionDropdown();
                        $('#classSelectStudent').prop('disabled', false);

                        if (classes.length) {
                            $.each(classes, function(_, cls) {
                                $('#classSelectStudent').append($('<option>', {
                                    value: cls.id,
                                    text: cls.class_name
                                }));
                            });
                        }

                        if (selectedClassId) {
                            $('#classSelectStudent').val(selectedClassId);
                        }
                        $('#classSelectStudent').niceSelect('update');

                        if (selectedClassId) {
                            loadSectionsByBoardClass(boardId, selectedClassId, selectedSectionId);
                        }
                    },
                    error: function() {
                        logBulk("Class load failed");
                        resetClassDropdown();
                        resetSectionDropdown();
                    }
                });
            }

            function loadSectionsByBoardClass(boardId, classId, selectedSectionId = '') {
                const baseUrl = $('#url').val();
                logBulk("Loading sections", {
                    board_id: boardId,
                    class_id: classId,
                    academic_id: $('#academic_year').val()
                });
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        academic_id: $('#academic_year').val()
                    },
                    url: baseUrl + '/admission/get-sections-by-board-class/' + encodeURIComponent(boardId) + '/' + classId,
                    success: function(sections) {
                        logBulk("Sections loaded", sections);
                        resetSectionDropdown();
                        $('#sectionSelectStudent').prop('disabled', false);

                        if (sections.length) {
                            $.each(sections, function(_, section) {
                                $('#sectionSelectStudent').append($('<option>', {
                                    value: section.id,
                                    text: section.section_name
                                }));
                            });
                        }

                        if (selectedSectionId) {
                            $('#sectionSelectStudent').val(selectedSectionId);
                        }
                        $('#sectionSelectStudent').niceSelect('update');
                    },
                    error: function() {
                        logBulk("Section load failed");
                        resetSectionDropdown();
                    }
                });
            }

            $(document).ready(function() {
                logBulk("Page ready");
                resetClassDropdown();
                resetSectionDropdown();

                $(document).on('change', '#upload_content_file', function() {
                    const file = this.files && this.files.length ? this.files[0] : null;
                    logBulk("File selected", {
                        file_name: file ? file.name : null,
                        file_size: file ? file.size : null,
                        file_type: file ? file.type : null
                    });
                });

                $(document).on('change', '#import_board_id', function() {
                    const boardId = $(this).val();
                    logBulk("Board changed", {
                        board_id: boardId
                    });
                    resetClassDropdown();
                    resetSectionDropdown();

                    if (!boardId) {
                        return;
                    }
                    loadClassesByBoard(boardId);
                });

                $(document).on('change', '#classSelectStudent', function() {
                    const boardId = $('#import_board_id').val();
                    const classId = $(this).val();
                    logBulk("Class changed", {
                        board_id: boardId,
                        class_id: classId
                    });
                    resetSectionDropdown();

                    if (!boardId || !classId) {
                        return;
                    }
                    loadSectionsByBoardClass(boardId, classId);
                });

                const initialBoardId = $('#import_board_id').val();
                if (initialBoardId) {
                    loadClassesByBoard(initialBoardId, oldClassId, oldSectionId);
                }

                $(document).on('change', '#sectionSelectStudent', function() {
                    logBulk("Section changed", {
                        section_id: $(this).val()
                    });
                });

                $('#student_form').on('submit', function() {
                    const fileInput = document.getElementById('upload_content_file');
                    const file = fileInput && fileInput.files && fileInput.files.length ? fileInput.files[0] : null;
                    logBulk("Submitting form", {
                        session: $('#academic_year').val(),
                        board_id: $('#import_board_id').val(),
                        class_id: $('#classSelectStudent').val(),
                        section_id: $('#sectionSelectStudent').val(),
                        file_name: file ? file.name : null
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
