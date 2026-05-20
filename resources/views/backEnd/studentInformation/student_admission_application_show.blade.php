@extends('backEnd.master')
@section('title')
    Application {{ $application->application_id }}
@endsection

@section('mainContent')
    <section class="sms-breadcrumb mb-20 up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Application {{ $application->application_id }}</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="{{ route('student_admission_applications') }}">Applications</a>
                    <a href="#">Details</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="white-box">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Student Information</h4>
                        <p><strong>Name:</strong> {{ ($payload['first_name'] ?? '') . ' ' . ($payload['last_name'] ?? '') }}</p>
                        <p><strong>Class:</strong> {{ $payload['class'] ?? '-' }}</p>
                        <p><strong>Board:</strong> {{ $payload['board_id'] ?? '-' }}</p>
                        <p><strong>Date of Birth:</strong> {{ $payload['date_of_birth'] ?? '-' }}</p>
                        <p><strong>Gender:</strong> {{ $payload['gender'] ?? '-' }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4>Contact</h4>
                        <p><strong>Mobile:</strong> {{ $payload['phone_number'] ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $payload['email_address'] ?? '-' }}</p>
                        <p><strong>Address:</strong> {{ $payload['current_address'] ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h4>Raw Application Data</h4>
                    <pre style="background:#f9fafb;padding:12px;border-radius:6px;">{{ json_encode($payload, JSON_PRETTY_PRINT) }}</pre>
                </div>
            </div>
        </div>
    </section>
@endsection
