<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Set locale for Carbon (Indonesian)
        Carbon::setLocale('id'); // 'id' is the locale for Indonesian

        // Set locale for PHP
        setlocale(LC_TIME, 'id_ID.UTF-8'); // For date/time functions in PHP

        // Get employees and sort by ID
        $employees = DB::table('gov_employee')->orderBy('id', 'asc')->get();

        // Get the earliest and latest attendance dates
        $startDate = DB::table('attendances')->min('scan_date');
        $endDate = DB::table('attendances')->max('scan_date');

        // Get 'from_date' and 'to_date' from the request (if set, else use default)
        $fromDate = $request->input('from_date', $startDate); // Default to the earliest attendance date
        $toDate = $request->input('to_date', $endDate); // Default to the end of the year

        // Generate calendar dates between 'from_date' and 'to_date'
        $dates = [];
        $currentDate = Carbon::parse($fromDate);
        while ($currentDate <= Carbon::parse($toDate)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Fetch attendance data within the date range
        $attendances = DB::table('attendances')
            ->leftJoin('ref_att_type', 'attendances.att_type_id', '=', 'ref_att_type.id')
            ->leftJoin('gov_employee', 'attendances.employee_id', '=', 'gov_employee.id')
            ->whereBetween(DB::raw('DATE(attendances.scan_date)'), [$fromDate, $toDate])
            ->get(['attendances.employee_id', 'attendances.scan_date', 'attendances.att_type_id', 'gov_employee.name as employee_name']);

        // Group attendance data by employee and date
        $attendanceData = [];
        foreach ($attendances as $attendance) {
            $employeeId = $attendance->employee_id;
            $attendanceDate = Carbon::parse($attendance->scan_date)->format('Y-m-d'); // Extract date only

            if (!isset($attendanceData[$employeeId])) {
                $attendanceData[$employeeId] = [
                    'employee_name' => $attendance->employee_name,
                    'attendances' => []
                ];
            }

            $attendanceData[$employeeId]['attendances'][$attendanceDate][$attendance->att_type_id] = Carbon::parse($attendance->scan_date)->format('H:i');
        }

        // Sorting attendance data by employee name
        ksort($attendanceData);

        // Return the view with necessary data
        return view('attendance.index', compact('attendanceData', 'dates', 'employees'));
    }
}
