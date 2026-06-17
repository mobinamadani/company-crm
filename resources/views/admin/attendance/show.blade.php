@extends('layouts.app')
@section('title', 'گزارش حضور و غیاب')
@section('content')

    <style>
        .report-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 25px rgba(0,0,0,.05);
        }

        .filter-box {
            background: #f8fafc;
            border-radius: 14px;
            padding: 15px;
        }

        .table thead th {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
        }

        .badge-soft {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .badge-present {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-late {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-absent {
            background: #fee2e2;
            color: #dc2626;
        }

        .title {
            font-weight: 700;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
        }
    </style>

    <div class="report-card card">

        <div class="card-body">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3" >

                <div>
                    <div class="title">گزارش حضور و غیاب</div>
                    <div class="subtitle">مدیریت وضعیت حضور کاربران</div>
                </div>

            </div>

            <!-- FILTERS -->
            <div class="filter-box mb-4">

                <form method="GET" class="row g-2">

                    <div class="col-md-5">
                        <select name="user_id" class="form-select">
                            <option value="">همه کاربران</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    @selected(request('user_id') == $user->id)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5">

                        @php
                            $months = [
                                1 => 'فروردین',2=>'اردیبهشت',3=>'خرداد',
                                4=>'تیر',5=>'مرداد',6=>'شهریور',
                                7=>'مهر',8=>'آبان',9=>'آذر',
                                10=>'دی',11=>'بهمن',12=>'اسفند'
                            ];
                        @endphp

                        <select name="month" class="form-select">
                            <option value="">همه ماه‌ها</option>
                            @foreach($months as $key => $name)
                                <option value="{{ $key }}"
                                    @selected(request('month') == $key)>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-dark w-100">
                            فیلتر
                        </button>
                    </div>

                </form>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>کاربر</th>
                        <th>تاریخ</th>
                        <th>ورود</th>
                        <th>خروج</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            <td>{{ $attendance->id }}</td>

                            <td class="fw-semibold">
                                {{ $attendance->user->name }}
                            </td>

                            <td>{{ $attendance->shamsi_date }}</td>

                            <td>{{ $attendance->check_in ?? '—' }}</td>
                            <td>{{ $attendance->check_out ?? '—' }}</td>

                            <td>

                                @if($attendance->status == 'present')
                                    <span class="badge-soft badge-present">حاضر</span>

                                @elseif($attendance->status == 'late')
                                    <span class="badge-soft badge-late">تاخیر</span>

                                @elseif($attendance->status == 'absent')
                                    <span class="badge-soft badge-absent">غایب</span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                هیچ رکوردی یافت نشد
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $attendances->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
