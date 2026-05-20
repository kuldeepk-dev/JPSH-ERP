<?php

namespace App\Imports;

use App\StudentBulkTemporary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class StudentsImport implements ToModel, WithHeadingRow, WithStartRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $attributes = [
            'admission_number' => (string) @$row['admission_number'],
            'roll_no' => (string) @$row['roll_no'],
            'first_name' => @$row['first_name'],
            'last_name' => @$row['last_name'],
            'date_of_birth' => $this->normalizeDateValue($row['date_of_birth'] ?? null),
            'religion' => @$row['religion'],
            'gender' => @$row['gender'],
            'caste' => @$row['caste'],
            'mobile' => (string) @$row['mobile'],
            'email' => @$row['email'],
            'admission_date' => $this->normalizeDateValue($row['admission_date'] ?? null) ?: date('Y-m-d'),
            'blood_group' => @$row['blood_group'],
            'height' => @$row['height'],
            'weight' => @$row['weight'],
            'father_name' => @$row['father_name'],
            'father_phone' => (string) @$row['father_phone'],
            'father_occupation' => @$row['father_occupation'],
            'mother_name' => @$row['mother_name'],
            'mother_phone' => (string) @$row['mother_phone'],
            'mother_occupation' => @$row['mother_occupation'],
            'guardian_name' => @$row['guardian_name'],
            'guardian_relation' => @$row['guardian_relation'],
            'guardian_email' => @$row['guardian_email'],
            'guardian_phone' => (string) @$row['guardian_phone'],
            'guardian_occupation' => @$row['guardian_occupation'],
            'guardian_address' => @$row['guardian_address'],
            'current_address' => @$row['current_address'],
            'permanent_address' => @$row['permanent_address'],
            'bank_account_no' => (string) @$row['bank_account_no'],
            'bank_name' => @$row['bank_name'],
            'national_identification_no' => (string) @$row['national_identification_no'],
            'local_identification_no' => (string) @$row['local_identification_no'],
            'previous_school_details' => (string) @$row['previous_school_details'],
            'note' => @$row['note'],
            'user_id' => Auth::user()->id,
        ];

        if (Schema::hasColumn('student_bulk_temporaries', 'board_name')) {
            $attributes['board_name'] = trim((string) (@$row['board'] ?? @$row['board_name'] ?? '')) ?: null;
        }
        if (Schema::hasColumn('student_bulk_temporaries', 'class_name')) {
            $attributes['class_name'] = trim((string) (@$row['class'] ?? @$row['class_name'] ?? '')) ?: null;
        }
        if (Schema::hasColumn('student_bulk_temporaries', 'section_name')) {
            $attributes['section_name'] = trim((string) (@$row['section'] ?? @$row['section_name'] ?? '')) ?: null;
        }

        return new StudentBulkTemporary($attributes);

    }

    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }

    private function normalizeDateValue($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
        }

        try {
            return Carbon::parse((string) $value)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }
}
