<?php

namespace App\Http\Controllers\Admin\FeesCollection;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeesCollection\SmFeesForwardSearchRequest;
use App\Http\Requests\FeesCarryForwardSettingsStoreRequest;
use App\Models\FeesCarryForwardLog;
use App\Models\FeesCarryForwardSettings;
use App\Models\StudentRecord;
use App\SmClass;
use App\SmFeesCarryForward;
use App\SmPaymentMethhod;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SmFeesCarryForwardController extends Controller
{
    public function feesForward(Request $request)
    {
        /*
        try {
        */
        $classes = SmClass::get();

        return view('backEnd.feesCollection.fees_forward', ['classes' => $classes]);
        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function universityFeesForwardSearch($request)
    {
        $request->all();
        /*
        try {
        */
        $students = StudentRecord::where('un_semester_label_id', $request->un_semester_label_id)
            ->where('un_section_id', $request->un_section_id)
            ->where('school_id', Auth::user()->school_id)
            ->whereHas('student', function ($q): void {
                $q->where('active_status', 1);
            })
            ->get();

        if ($students->count() !== 0) {
            foreach ($students as $student) {
                $fees_balance = SmFeesCarryForward::where('student_id', $student->student_id)->count();
            }

            if ($fees_balance == 0) {
                return view('backEnd.feesCollection.fees_forward', ['students' => $students]);
            }

            $update = '';

            return view('backEnd.feesCollection.fees_forward', ['students' => $students, 'update' => $update]);

        }

        Toastr::error('Operation Failed', 'Failed');

        return redirect('fees-forward');

        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function feesForwardSearch(SmFeesForwardSearchRequest $smFeesForwardSearchRequest)
    {
        if (moduleStatusCheck(('University'))) {
            return $this->universityFeesForwardSearch($smFeesForwardSearchRequest);
        }

        $input = $smFeesForwardSearchRequest->all();
        $validator = Validator::make($input, [
            'class' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        /*
        try {
        */
        $classes = SmClass::where('active_status', 1)
            ->where('academic_id', getAcademicId())
            ->where('school_id', Auth::user()->school_id)
            ->get();

        $students = StudentRecord::where('class_id', $smFeesForwardSearchRequest->class)
                ->where('section_id', $smFeesForwardSearchRequest->section)
                ->when(shiftEnable(), function ($query) use ($smFeesForwardSearchRequest) {
                    $query->where('shift_id', $smFeesForwardSearchRequest->shift);
                })
                ->where('school_id', Auth::user()->school_id)
                ->whereHas('student', function ($q): void {
                    $q->where('active_status', 1);
                })
                ->get();

        if ($students->count() !== 0) {
            foreach ($students as $student) {
                $fees_balance = SmFeesCarryForward::where('student_id', $student->student_id)->count();
            }

            $class_id = $smFeesForwardSearchRequest->class;
            $section_id = $smFeesForwardSearchRequest->section;
            $shift_id = shiftEnable() ? $smFeesForwardSearchRequest->shift : null;
            if ($fees_balance == 0) {
                return view('backEnd.feesCollection.fees_forward', ['classes' => $classes, 'students' => $students, 'shift_id' => $shift_id, 'section_id' => $section_id,  'class_id' => $class_id]);
            }

            $update = '';

            return view('backEnd.feesCollection.fees_forward', ['classes' => $classes, 'students' => $students, 'shift_id' => $shift_id, 'section_id' => $section_id,  'update' => $update, 'class_id' => $class_id]);

        }

        Toastr::error('Operation Failed', 'Failed');

        return redirect('fees-forward');

        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */

    }

    public function feesForwardStore(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->id as $student) {

                if ($request->update == 1) {

                    $fees_forward = SmFeesCarryForward::find($student);
                    if ($fees_forward) {
                        $fees_forward->balance = $request->balance[$student] ?? 0;
                        $fees_forward->notes = $request->notes[$student];
                        $fees_forward->save();
                    }
                } else {
                    $fees_forward = new SmFeesCarryForward();
                    $fees_forward->student_id = $student;
                    $fees_forward->balance = $request->balance[$student] ?? 0;
                    $fees_forward->notes = $request->notes[$student];
                    $fees_forward->school_id = Auth::user()->school_id;
                    $fees_forward->academic_id = getAcademicId();
                    $fees_forward->save();
                }
            }

            DB::commit();

            Toastr::success('Operation successful', 'Success');

            return redirect('fees-forward');
        } catch (Exception $exception) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }

    public function feesCarryForwardSettingsView()
    {
        /*
        try {
        */
        $settings = FeesCarryForwardSettings::first();
        $paymeny_gateway = SmPaymentMethhod::query();
        $paymeny_gateway = $paymeny_gateway->where('school_id', auth()->user()->school_id);
        $paymeny_gateway->where('method', '!=', 'Bank');
        if (moduleStatusCheck('XenditPayment') == false) {
            $paymeny_gateway->where('method', '!=', 'Xendit');
        }

        if (moduleStatusCheck('RazorPay') == false) {
            $paymeny_gateway->where('method', '!=', 'RazorPay');
        }

        if (moduleStatusCheck('Raudhahpay') == false) {
            $paymeny_gateway->where('method', '!=', 'Raudhahpay');
        }

        if (moduleStatusCheck('KhaltiPayment') == false) {
            $paymeny_gateway->where('method', '!=', 'Khalti');
        }

        if (moduleStatusCheck('MercadoPago') == false) {
            $paymeny_gateway->where('method', '!=', 'MercadoPago');
        }

        if (moduleStatusCheck('CcAveune') == false) {
            $paymeny_gateway->where('method', '!=', 'CcAveune');
        }

        $paymeny_gateway = $paymeny_gateway->withoutGlobalScope(ActiveStatusSchoolScope::class);
        $paymeny_gateway = $paymeny_gateway->get();

        return view('backEnd.systemSettings.feesCarryForwardSettingsView', ['settings' => $settings, 'paymeny_gateway' => $paymeny_gateway]);
        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function feesCarryForwardSettings(FeesCarryForwardSettingsStoreRequest $feesCarryForwardSettingsStoreRequest)
    {
        /*
        try {
        */
        $settings = FeesCarryForwardSettings::first();
        if ($feesCarryForwardSettingsStoreRequest->title) {
            $settings->title = $feesCarryForwardSettingsStoreRequest->title;
        }

        if ($feesCarryForwardSettingsStoreRequest->fees_due_days) {
            $settings->fees_due_days = $feesCarryForwardSettingsStoreRequest->fees_due_days;
        }

        if ($feesCarryForwardSettingsStoreRequest->payment_gateway) {
            $settings->payment_gateway = $feesCarryForwardSettingsStoreRequest->payment_gateway;
        }

        $settings->save();

        Toastr::success('Operation successful', 'Success');
        if (generalSetting()->fees_status == 1) {
            return redirect()->route('fees-carry-forward-settings-view');
        }

        return redirect()->route('fees-carry-forward-settings-view-fees-collection');

        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function feesCarryForward()
    {
        /*
        try {
        */
        $classes = SmClass::get();

        return view('backEnd.systemSettings.feesCarryForwardView', ['classes' => $classes]);
        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function feesCarryForwardSearch(SmFeesForwardSearchRequest $smFeesForwardSearchRequest)
    {
        /*
        try {
        */
        $data['classes'] = SmClass::where('active_status', 1)
            ->where('academic_id', getAcademicId())
            ->where('school_id', Auth::user()->school_id)
            ->get();

        $data['students'] = StudentRecord::with('studentDetail.forwardBalance')
            ->where('class_id', $smFeesForwardSearchRequest->class)
            ->where('section_id', $smFeesForwardSearchRequest->section)
            ->where('school_id', Auth::user()->school_id)
            ->whereHas('student', function ($q): void {
                $q->where('active_status', 1);
            })
            ->get();

        $data['settings'] = FeesCarryForwardSettings::first();

        if ($data['students']->count() !== 0) {
            foreach ($data['students'] as $student) {
                $fees_balance = SmFeesCarryForward::where('student_id', $student->student_id)->count();
            }

            $data['class_id'] = $smFeesForwardSearchRequest->class;

            return view('backEnd.systemSettings.feesCarryForwardView', $data);
        }

        Toastr::error('No Student Found', 'Failed');
        if (generalSetting()->fees_status == 1) {
            return redirect()->route('fees-carry-forward-view');
        }

        return redirect()->route('fees-carry-forward-view-fees-collection');
        /*
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function feesCarryForwardStore(Request $request)
    {
        /*
        try {
        */
        foreach (gv($request, 'studentFeesInfo') as $studentInfo) {
            $type = 'add';
            if (preg_match('/[+,-]/i', gv($studentInfo, 'balance'), $match)) {
                $data = $match[0];
                $type = $data == '+' ? 'add' : 'due';
            }

            $deleteData = SmFeesCarryForward::where('student_id', gv($studentInfo, 'student_id'))->first();
            $studentBaseAmount = SmFeesCarryForward::where('student_id', gv($studentInfo, 'student_id'))->sum('balance');
            if ($deleteData) {
                $transcationAmount = $studentBaseAmount - abs(gv($studentInfo, 'balance', 0));
            } else {
                $transcationAmount = abs(gv($studentInfo, 'balance', 0));
            }

            if ($deleteData) {
                $deleteData->delete();
            }

            $fees_forward = new SmFeesCarryForward();
            $fees_forward->student_id = gv($studentInfo, 'student_id');
            $fees_forward->balance = abs(gv($studentInfo, 'balance', 0));
            $fees_forward->balance_type = $type;
            $fees_forward->due_date = date('Y-m-d', strtotime(gv($studentInfo, 'due_date')));
            $fees_forward->notes = gv($studentInfo, 'notes');
            $fees_forward->school_id = auth()->user()->school_id;
            $fees_forward->academic_id = getAcademicId();
            $fees_forward->save();

            // Carry Forward Log Start
            $storeLog = new FeesCarryForwardLog();
            $storeLog->student_record_id = gv($studentInfo, 'student_id');
            $storeLog->amount = $transcationAmount;
            $storeLog->amount_type = $type;
            if (generalSetting()->fees_status == 1) {
                $storeLog->amount_type = 'fees';
            } else {
                $storeLog->type = 'installment';
            }

            $storeLog->date = date('Y-m-d H:i:s');
            $storeLog->note = gv($studentInfo, 'notes');
            $storeLog->created_by = auth()->user()->id;
            $storeLog->school_id = auth()->user()->school_id;
            $storeLog->save();
            // Carry Forward Log End
        }

        Toastr::success('Operation successful', 'Success');
        if (generalSetting()->fees_status == 1) {
            return redirect()->route('fees-carry-forward-view');
        }

        return redirect()->route('fees-carry-forward-view-fees-collection');

        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function feesCarryForwardLogView()
    {
        /*
        try {
        */
        $classes = SmClass::get();

        return view('backEnd.systemSettings.feesCarryForwardLogView', ['classes' => $classes]);
        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }

    public function feesCarryForwardLogSearch()
    {
        /*
        try {
        */
        $logs = FeesCarryForwardLog::with('studentRecord', 'studentRecord.studentDetail')
            ->when(request()->student_id, function ($s): void {
                $s->where('student_record_id', request()->student_id);
            })
            ->where('type', request()->fees_type);

        return DataTables::of($logs)
            ->addIndexColumn()
            ->editColumn('student_id', function ($log) {
                return $log->studentRecord->studentDetail->full_name ?? '';
            })
            ->addColumn('note', function ($log) {
                return $log->note ?? '';
            })
            ->addColumn('amount', function ($log) {
                return $log->amount ?? '';
            })
            ->editColumn('date', function ($log) {
                return dateConvert($log->date);
            })
            ->toJson();
        /*
        } catch (Exception $exception) {
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
        */
    }
}
