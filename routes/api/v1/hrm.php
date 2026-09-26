
<?php

use App\Http\Controllers\Api\V1\Modules\Hrm\AttendenceDeviceController;
use App\Http\Controllers\Api\V1\Modules\Hrm\EmployeeLoanController;
use App\Http\Controllers\Api\V1\Modules\Hrm\FiscalYearController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Holidays\HolidayController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Holidays\HolidayGroupController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Leaves\LeaveApprovalController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Leaves\LeaveBalanceController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Leaves\LeavePolicyController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Leaves\LeaveRequestController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Leaves\LeaveTypeController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Payrolls\PayElementController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Payrolls\PayrollAdjustmentController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Payrolls\PayrollRunController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Payrolls\PayslipController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Payrolls\PayslipLineController;
use App\Http\Controllers\Api\V1\Modules\Hrm\Payrolls\SalaryComponentController;
use App\Http\Controllers\Api\V1\Modules\Hrm\ShiftAssignmentController;
use App\Http\Controllers\Api\V1\Modules\Hrm\ShiftController;
use App\Http\Controllers\Api\V1\Modules\Hrm\WorkScheduleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['verify.jwt']], function () {

    Route::prefix('hrm')->group(function () {

        Route::get('work-schedules/list', [WorkScheduleController::class, 'list']);
        Route::apiResource('work-schedules', WorkScheduleController::class);
        Route::patch('work-schedules/{id}/status', [WorkScheduleController::class, 'status']);

        Route::get('shifts/list', [ShiftController::class, 'list']);
        Route::apiResource('shifts', ShiftController::class);
        Route::patch('shifts/{id}/status', [ShiftController::class, 'status']);

        Route::get('shift-assignments/list', [ShiftAssignmentController::class, 'list']);
        Route::apiResource('shift-assignments', ShiftAssignmentController::class);

        Route::get('attendence-devices/list', [AttendenceDeviceController::class, 'list']);
        Route::apiResource('attendence-devices', AttendenceDeviceController::class);
        Route::patch('attendence-devices/{id}/status', [AttendenceDeviceController::class, 'status']);

        Route::get('fiscal-years/list', [FiscalYearController::class, 'list']);
        Route::apiResource('fiscal-years', FiscalYearController::class);
        Route::patch('fiscal-years/{id}/status', [FiscalYearController::class, 'status']);
    });

    Route::prefix('hrm/leaves')->group(function () {

        Route::get('leave-types/list', [LeaveTypeController::class, 'list']);
        Route::apiResource('leave-types', LeaveTypeController::class);

        Route::get('leave-policies/list', [LeavePolicyController::class, 'list']);
        Route::apiResource('leave-policies', LeavePolicyController::class);

        Route::get('leave-balances/list', [LeaveBalanceController::class, 'list']);
        Route::apiResource('leave-balances', LeaveBalanceController::class);

        Route::get('leave-requests/list', [LeaveRequestController::class, 'list']);
        Route::apiResource('leave-requests', LeaveRequestController::class);
        Route::patch('leave-requests/{id}/status', [LeaveRequestController::class, 'status']);

        Route::get('leave-approvals/list', [LeaveApprovalController::class, 'list']);
        Route::apiResource('leave-approvals', LeaveApprovalController::class);
        Route::patch('leave-approvals/{id}/status', [LeaveApprovalController::class, 'status']);

    });

    Route::prefix('hrm/holidays')->group(function () {

        Route::get('holiday-groups/list', [HolidayGroupController::class, 'list']);
        Route::apiResource('holiday-groups', HolidayGroupController::class);
        Route::patch('holiday-groups/{id}/status', [HolidayGroupController::class, 'status']);

        Route::get('holidays/list', [HolidayController::class, 'list']);
        Route::apiResource('holidays', HolidayController::class);
        Route::patch('holidays/{id}/status', [HolidayController::class, 'status']);

    });

    Route::prefix('hrm')->group(function () {

        Route::get('employee-loans/list', [EmployeeLoanController::class, 'list']);
        Route::apiResource('employee-loans', EmployeeLoanController::class);
        Route::patch('employee-loans/{id}/status', [EmployeeLoanController::class, 'status']);

    });

    Route::prefix('hrm/payrolls')->group(function () {

        Route::get('pay-elements/list', [PayElementController::class, 'list']);
        Route::apiResource('pay-elements', PayElementController::class);

        Route::get('salary-components/list', [SalaryComponentController::class, 'list']);
        Route::apiResource('salary-components', SalaryComponentController::class);

        Route::get('payroll-runs/list', [PayrollRunController::class, 'list']);
        Route::apiResource('payroll-runs', PayrollRunController::class);
        Route::patch('payroll-runs/{id}/status', [PayrollRunController::class, 'status']);

        Route::get('payslips/list', [PayslipController::class, 'list']);
        Route::apiResource('payslips', PayslipController::class);
        Route::patch('payslips/{id}/status', [PayslipController::class, 'status']);

        Route::get('payslip-lines/list', [PayslipLineController::class, 'list']);
        Route::apiResource('payslip-lines', PayslipLineController::class);

        Route::get('payroll-adjustments/list', [PayrollAdjustmentController::class, 'list']);
        Route::apiResource('payroll-adjustments', PayrollAdjustmentController::class);

    });
});
