@extends('layouts.app')

@section('title', 'گزارش حضور و غیاب')

@section('content')

    <div class="card border-0 shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">گزارش حضور و غیاب کاربران</h5>
        </div>

        <div class="card-body">

            {{-- Filters --}}
            <form method="GET" class="row g-3 mb-4">

                {{-- Users --}}
                <div class="col-md-5">

{{--                    <label class="form-label">--}}
{{--                        انتخاب کاربر--}}
{{--                    </label>--}}

                    <select name="user_id" class="form-select">

                        <option value="">
                            همه کاربران
                        </option>

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                @selected(request('user_id') == $user->id)>

                                {{ $user->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Months (Shamsi) --}}
                <div class="col-md-5">

{{--                    <label class="form-label">--}}
{{--                        انتخاب ماه--}}
{{--                    </label>--}}

                    @php
                        $months = [
                            1 => 'فروردین',
                            2 => 'اردیبهشت',
                            3 => 'خرداد',
                            4 => 'تیر',
                            5 => 'مرداد',
                            6 => 'شهریور',
                            7 => 'مهر',
                            8 => 'آبان',
                            9 => 'آذر',
                            10 => 'دی',
                            11 => 'بهمن',
                            12 => 'اسفند',
                        ];
                    @endphp

                    <select name="month" class="form-select">

                        <option value="">
                            همه ماه‌ها
                        </option>

                        @foreach($months as $key => $name)

                            <option
                                value="{{ $key }}"
                                @selected(request('month') == $key)>

                                {{ $name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Submit --}}
                <div class="col-md-2 d-flex align-items-end">

                    <button type="submit" class="btn btn-primary w-100">
                        فیلتر
                    </button>

                </div>

            </form>

            {{-- Table --}}
            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                    <tr>
                        <th>id</th>
                        <th>کاربر</th>
                        <th>تاریخ</th>
                        <th>ساعت ورود</th>
                        <th>ساعت خروج</th>
                        <th>وضعیت</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            <td>{{ $attendance->id }}</td>

                            <td>{{ $attendance->user->name }}</td>

                            <td>{{ $attendance->shamsi_date }}</td>

                            <td>{{ $attendance->check_in ?? '-' }}</td>

                            <td>{{ $attendance->check_out ?? '-' }}</td>

                            <td>

                                @if($attendance->status == 'present')
                                    <span class="badge bg-success">حاضر</span>

                                @elseif($attendance->status == 'late')
                                    <span class="badge bg-warning text-dark">تاخیر</span>

                                @elseif($attendance->status == 'absent')
                                    <span class="badge bg-danger">غایب</span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                هیچ رکوردی یافت نشد
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $attendances->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
