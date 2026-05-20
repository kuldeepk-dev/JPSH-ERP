@extends('backEnd.master')
@section('title')
    Student Admission Applications
@endsection

@section('mainContent')
    <section class="sms-breadcrumb mb-20 up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Student Admission Applications</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="#">Student Admission</a>
                    <a href="#">Applications</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table Crm_table_active3">
                        <thead>
                            <tr>
                                <th>Application ID</th>
                                <th>Student Name</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                @php
                                    $payload = json_decode((string) $application->data_json, true) ?: [];
                                    $studentName = trim(($payload['first_name'] ?? '') . ' ' . ($payload['last_name'] ?? ''));
                                @endphp
                                <tr>
                                    <td>{{ $application->application_id }}</td>
                                    <td>{{ $studentName ?: '-' }}</td>
                                    <td>
                                        <form action="{{ route('student_admission_application_status', $application->id) }}" method="POST">
                                            @csrf
                                            <select name="status" class="primary_select form-control" onchange="this.form.submit()">
                                                @foreach (['pending','under_review','approved','rejected'] as $status)
                                                    <option value="{{ $status }}" {{ $application->status === $status ? 'selected' : '' }}>
                                                        {{ ucwords(str_replace('_', ' ', $status)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ optional($application->submitted_at)->format('Y-m-d H:i') ?? '-' }}</td>
                                    <td>
                                        <a class="primary-btn small fix-gr-bg" href="{{ route('student_admission_application_show', $application->id) }}">View</a>
                                        <a class="primary-btn small tr-bg" href="{{ route('student_admission_application_pdf', $application->id) }}">PDF</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
