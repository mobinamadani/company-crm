<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        $attendances = Attendance::with('user')

            ->when($request->user_id, function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })

            ->when($request->month, function ($query) use ($request) {

                $year = Jalalian::now()->getYear();

                $startDate = Jalalian::fromFormat(
                    'Y/n/j',
                    $year . '/' . $request->month . '/1'
                )->toCarbon();

                $endDate = (clone $startDate)
                    ->addMonth()
                    ->subDay();

                $query->whereBetween('date', [
                    $startDate->startOfDay(),
                    $endDate->endOfDay(),
                ]);
            })

            ->latest('date')
            ->paginate(20);

        return view('admin.attendance.show', compact('attendances', 'users'));
    }

    public function getWorkHoursAttribute()
    {
        if(!$this->check_out)
            return '-';

        return \Carbon\Carbon::parse($this->check_in)
            ->diff(
                \Carbon\Carbon::parse($this->check_out)
            )
            ->format('%H:%I');
    }
}
