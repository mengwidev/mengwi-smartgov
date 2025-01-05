<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8');

        $employees = DB::table('gov_employee')->orderBy('id', 'asc')->get();

        $startDate = DB::table('attendances')->min('scan_date');
        $endDate = DB::table('attendances')->max('scan_date');

        $fromDate = $request->input('from_date', $startDate);
        $toDate = $request->input('to_date', $endDate);

        $dates = [];
        $currentDate = Carbon::parse($fromDate);
        while ($currentDate <= Carbon::parse($toDate)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        $attendances = DB::table('attendances')
            ->leftJoin('ref_att_type', 'attendances.att_type_id', '=', 'ref_att_type.id')
            ->leftJoin('gov_employee', 'attendances.employee_id', '=', 'gov_employee.id')
            ->whereBetween(DB::raw('DATE(attendances.scan_date)'), [$fromDate, $toDate])
            ->get(['attendances.employee_id', 'attendances.scan_date', 'attendances.att_type_id', 'gov_employee.name as employee_name']);

        $attendanceData = [];
        foreach ($employees as $employee) {
            $attendanceData[$employee->id] = [
                'employee_name' => $employee->name,
                'attendances' => []
            ];

            foreach ($dates as $date) {
                $dayOfWeek = Carbon::parse($date)->dayOfWeek;
                if ($dayOfWeek === 0 || $dayOfWeek === 6) {
                    $attendanceData[$employee->id]['attendances'][$date] = [
                        1 => 'Libur',
                        2 => 'Libur',
                    ];
                } else {
                    $attendanceData[$employee->id]['attendances'][$date] = [
                        1 => '--',
                        2 => '--',
                    ];
                }
            }
        }

        foreach ($attendances as $attendance) {
            $employeeId = $attendance->employee_id;
            $attendanceDate = Carbon::parse($attendance->scan_date)->format('Y-m-d');

            if (isset($attendanceData[$employeeId]['attendances'][$attendanceDate])) {
                $attendanceData[$employeeId]['attendances'][$attendanceDate][$attendance->att_type_id] = Carbon::parse($attendance->scan_date)->format('H:i');
            }
        }

        return view('attendance.index', compact('attendanceData', 'dates', 'employees'));
    }
}
