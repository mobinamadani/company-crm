@extends('layouts.app')

@section('title', 'داشبورد')

@section('content')

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <!-- Left -->
        <div>
            <h3 class="mb-1">داشبورد CRM</h3>
            <p class="text-muted mb-0">
                خوش آمدی {{ auth()->user()->name }}
            </p>
        </div>

        <!-- Right -->
        <div class="d-flex align-items-center gap-3">

            <!-- Notifications -->
            <div class="dropdown">

                <button class="btn btn-light position-relative dropdown-toggle"
                        data-bs-toggle="dropdown">

                    <i class="bi bi-bell fs-5"></i>

                    @if(auth()->user()->unreadNotifications->count())
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                    @endif

                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                    @forelse(auth()->user()->unreadNotifications as $notification)

                        <li>
                            <a class="dropdown-item py-2"
                               href="{{ route('notifications.read', $notification->id) }}">

                                <div class="fw-bold">
                                    {{ $notification->data['message'] }}
                                </div>

                                @if(!empty($notification->data['title']))
                                    <small class="text-muted">
                                        {{ $notification->data['title'] }}
                                    </small>
                                @endif

                            </a>
                        </li>

                    @empty

                        <li>
                        <span class="dropdown-item text-muted text-center">
                            نوتیفیکیشنی وجود ندارد
                        </span>
                        </li>

                    @endforelse

                    @if(auth()->user()->unreadNotifications->count())
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-center text-primary"
                               href="{{ route('notifications.read.all') }}">
                                خواندن همه
                            </a>
                        </li>
                    @endif

                </ul>

            </div>

            <!-- Role Badge -->
            <span class="badge bg-primary fs-6">
            {{ auth()->user()->roles->pluck('name')->join(', ') }}
        </span>

        </div>
    </div>

    <!-- Statistics -->
    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

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

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

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

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="text-muted">تعداد نقش‌ها</h6>
                        <h2>{{ \Spatie\Permission\Models\Role::count() }}</h2>
                    </div>

                    <div class="fs-1 text-warning">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Quick Access -->
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h5 class="mb-4">دسترسی سریع</h5>

            <div class="row">

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

                <div class="col-md-3 mb-3">
                    <a href="{{ route('attendance.index') }}"
                       class="btn btn-outline-info w-100 py-3">

                        <i class="bi bi-table d-block fs-3 mb-2"></i>
                        گزارش حضور و غیاب

                    </a>
                </div>

                @endrole

                <div class="col-md-3 mb-3">
                    <a href="{{ route('attendance.index') }}"
                       class="btn btn-outline-warning w-100 py-3">

                        <i class="bi bi-calendar-check d-block fs-3 mb-2"></i>
                        حضور و غیاب

                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="{{ route('task.index') }}"
                       class="btn btn-outline-dark w-100 py-3">

                        <i class="bi bi-list-task d-block fs-3 mb-2"></i>
                        تسک‌ها

                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="{{ route('leaves.index') }}"
                       class="btn btn-outline-danger w-100 py-3">

                        <i class="bi bi-calendar-x d-block fs-3 mb-2"></i>
                        مرخصی‌ها

                    </a>
                </div>

            </div>

        </div>

    </div>

@endsection
