@extends('layouts.app')
@section('title', 'داشبورد')
@section('content')
    <!------ Header ------>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">داشبورد CRM</h3>

            <p class="text-muted mb-0">خوش آمدی {{ auth()->user()->name }}</p>
        </div>

        <div>
            <span class="badge bg-primary">
                {{ auth()->user()->roles->pluck('name')->join(', ') }}
            </span>
        </div>
    </div>

    <!------ Statistics ------>
    <div class="row">
        <!-- Users Count -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">تعداد کاربران</h6>

                            <h2>{{ \App\Models\User::count() }}</h2>
                        </div>

                        <div class="fs-1 text-primary">
                            <i class="bi bi-people"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!----- Active Users ------>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">کاربران فعال</h6>

                            <h2>{{ \App\Models\User::where('is_active', 1)->count() }}</h2>
                        </div>

                        <div class="fs-1 text-success">
                            <i class="bi bi-person-check"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!----- Roles ----->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">تعداد نقش‌ها</h6>

                            <h2>
                                {{ \Spatie\Permission\Models\Role::count() }}
                            </h2>

                        </div>

                        <div class="fs-1 text-warning">
                            <i class="bi bi-shield-lock"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------ Quick Access ----->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">دسترسی سریع</h5>

            <div class="row">
                <!-- Users -->
                <!-- فقط ادمین ببیند -->
                @role('admin')

                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-outline-primary w-100 py-3">

                        <i class="bi bi-people d-block fs-3 mb-2"></i>

                        مدیریت کاربران
                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.create') }}"
                       class="btn btn-outline-success w-100 py-3">

                        <i class="bi bi-person-plus d-block fs-3 mb-2"></i>

                        افزودن کاربر
                    </a>
                </div>

                @endrole

                <!-- Attendance Of User -->
                <div class="col-md-3 mb-3">
                    <a href="{{ route('attendance.index') }}"
                       class="btn btn-outline-warning w-100 py-3">
                        <i class="bi bi-calendar-check d-block fs-3 mb-2"></i>
                        حضور و غیاب

                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
