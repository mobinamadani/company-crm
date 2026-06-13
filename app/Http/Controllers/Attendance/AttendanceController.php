<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $todayAttendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', today())
            ->first();

        return view('admin.attendance.index', compact('todayAttendance'));
    }

    public function checkIn()
    {
        $hour = now()->hour;

        if($hour < 8 || $hour > 17){
            return back()->with('error', 'ثبت ورود فقط بین ساعت 8 تا 17 مجاز است');
        }

        $exists = Attendance::where('user_id', auth()->id())
            ->whereDate('date', today())
            ->exists();

        if($exists){
            return back()->with('error', 'ورود امروز قبلا ثبت شده است');
        }

        Attendance::create([
            'user_id' => auth()->id(),
            'date' => today(),
            'check_in' => now()->format('H:i:s'),
            'status' => now()->format('H:i') > '08:00'
                ? 'late'
                : 'present',
        ]);

        return back()->with('success', 'ورود با موفقیت ثبت شد');
    }

    public function checkOut()
    {
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', today())
            ->first();

        if(!$attendance){
            return back()->with('error', 'ابتدا ورود ثبت کنید');
        }

        if($attendance->chck_out){
            return back()->with('error' , 'خروج قبلا ثبت شده است');
        }

        $attendance->update([
            'check_out' => now()->format('H:i:s')
        ]);

        return back()->with('success', 'خروج ثبت شد');
    }
}
