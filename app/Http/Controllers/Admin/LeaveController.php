<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leaves;
use App\Models\User;
use App\Notifications\LeaveNotification;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class LeaveController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $leaves = Leaves::with('user')
                ->latest()
                ->paginate(20);
        } else {
            $leaves = Leaves::where('user_id', auth()->id())
                ->latest()
                ->paginate(20);
        }

        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('leaves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:daily,hourly',
            'leave_date' => 'required|string',
            'from_time' => 'nullable',
            'to_time' => 'nullable',
            'description' => 'nullable|string',
        ]);

        // تبدیل اعداد فارسی به انگلیسی
        $date = str_replace(
            ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
            ['0','1','2','3','4','5','6','7','8','9'],
            $request->leave_date
        );

        // تبدیل - به /
        $date = str_replace('-', '/', $date);

        // تبدیل جلالی به میلادی
        $gregorian = Jalalian::fromFormat('Y/m/d', $date)
            ->toCarbon()
            ->format('Y-m-d');

        //  ساخت مرخصی (اصلاح مهم)
        $leave = Leaves::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'leave_date' => $gregorian,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        //  ارسال نوتیفیکیشن به ادمین‌ها
        $admins = User::role('admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new LeaveNotification($leave, 'created'));
        }

        return redirect()->route('leaves.index')
            ->with('success', 'مرخصی ثبت شد');
    }

    public function approve(Leaves $leave)
    {
        $leave->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
        ]);

        // نوتیف به کاربر
        $leave->user->notify(new LeaveNotification($leave, 'approved'));

        return back()->with('success', 'مرخصی تایید شد');
    }

    public function reject(Leaves $leave)
    {
        $leave->update([
            'status' => 'rejected',
            'rejected_by' => auth()->id(),
        ]);

        // نوتیف به کاربر
        $leave->user->notify(new LeaveNotification($leave, 'rejected'));

        return back()->with('success', 'مرخصی رد شد');
    }
}
