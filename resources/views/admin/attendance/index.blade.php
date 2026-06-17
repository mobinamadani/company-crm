@extends('layouts.app')
@section('title', 'حضور و غیاب')
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4" >

        <div>
            <h3 class="mb-0 fw-bold">حضور و غیاب امروز</h3>
            <small class="text-muted">ثبت ورود و خروج روزانه</small>
        </div>

        <span class="badge bg-dark fs-6">
        {{ now()->format('Y-m-d') }}
    </span>

    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">

        <!-- Status Card -->
        <div class="col-md-6 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <h5 class="mb-4">وضعیت امروز</h5>

                    @if($todayAttendance)

                        <div class="mb-3">
                            <span class="text-muted">زمان ورود:</span><br>
                            <span class="fw-bold">
                            {{ $todayAttendance->check_in }}
                        </span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted">زمان خروج:</span><br>
                            <span class="fw-bold">
                            {{ $todayAttendance->check_out ?? 'ثبت نشده' }}
                        </span>
                        </div>

                        <div>
                            <span class="text-muted">وضعیت:</span><br>

                            @if($todayAttendance->status == 'present')
                                <span class="badge bg-success">حاضر</span>
                            @elseif($todayAttendance->status == 'late')
                                <span class="badge bg-warning">دیرکرد</span>
                            @else
                                <span class="badge bg-secondary">
                                {{ $todayAttendance->status }}
                            </span>
                            @endif

                        </div>

                    @else

                        <div class="text-muted text-center py-5">
                            هنوز هیچ رکوردی ثبت نشده
                        </div>

                    @endif

                </div>

            </div>

        </div>

        <!-- Actions Card -->
        <div class="col-md-6 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <h5 class="mb-4">عملیات</h5>

                    <div class="d-grid gap-3">

                        <form action="{{ route('attendance.checkin') }}" method="POST">
                            @csrf

                            <button class="btn btn-success w-100 py-3 shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                ثبت ورود
                            </button>

                        </form>

                        <form action="{{ route('attendance.checkout') }}" method="POST">
                            @csrf

                            <button class="btn btn-danger w-100 py-3 shadow-sm">
                                <i class="bi bi-box-arrow-right me-1"></i>
                                ثبت خروج
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
