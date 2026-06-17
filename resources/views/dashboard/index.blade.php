@extends('layouts.app')
@section('title', 'داشبورد')
@section('content')
    <style>
        .dashboard-header {
            background: linear-gradient(135deg,#4f46e5,#06b6d4);
            color: #fff;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            border: none;
            border-radius: 16px;
            transition: all .2s ease;
            box-shadow: 0 6px 20px rgba(0,0,0,.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,.1);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .quick-card {
            border: none;
            border-radius: 14px;
            transition: .2s;
        }

        .quick-card:hover {
            transform: scale(1.02);
        }
    </style>

    <!-- HEADER -->
    <div class="dashboard-header d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">داشبورد CRM</h3>
            <small>خوش آمدی {{ auth()->user()->name }}</small>
        </div>

        <div class="d-flex align-items-center gap-3">

            <!-- Notifications -->
            <div class="dropdown">

                <button class="btn btn-light position-relative dropdown-toggle"
                        data-bs-toggle="dropdown">

                    <i class="bi bi-bell"></i>

                    @php
                        $unreadCount = auth()->user()->unreadNotifications->count();
                    @endphp

                    @if($unreadCount)
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">
                {{ $unreadCount }}
            </span>
                    @endif

                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow" style="min-width: 280px;">

                    <!-- Header -->
                    <li class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                        <span class="fw-bold">نوتیفیکیشن‌ها</span>

                        @if($unreadCount)
                            <a href="{{ route('notifications.read.all') }}"
                               class="small text-primary text-decoration-none">
                                خواندن همه
                            </a>
                        @endif
                    </li>

                    @forelse(auth()->user()->notifications as $n)

                        <li>
                            <a class="dropdown-item py-2 {{ $n->read_at ? 'text-muted' : 'fw-bold' }}"
                               href="{{ route('notifications.read', $n->id) }}">

                                <div>
                                    {{ $n->data['message'] }}
                                </div>

                                @if(isset($n->data['title']))
                                    <small class="text-muted">
                                        {{ $n->data['title'] }}
                                    </small>
                                @endif

                            </a>
                        </li>

                    @empty

                        <li class="px-3 py-3 text-center text-muted">
                            نوتیفیکیشنی وجود ندارد
                        </li>

                    @endforelse

                </ul>

            </div>

            <!-- Role -->
            <span class="badge bg-dark fs-6" style="min-width: 120px; min-height: 40px;" >
            {{ auth()->user()->roles->pluck('name')->join(', ') }}
        </span>

        </div>
    </div>

    <!-- STATS -->
    <div class="row g-3">

        <div class="col-md-4">
            <div class="card stat-card p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">کاربران</h6>
                        <h3>{{ \App\Models\User::count() }}</h3>
                    </div>
                    <div class="icon-box bg-primary text-white">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">فعال‌ها</h6>
                        <h3>{{ \App\Models\User::where('is_active',1)->count() }}</h3>
                    </div>
                    <div class="icon-box bg-success text-white">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">نقش‌ها</h6>
                        <h3>{{ \Spatie\Permission\Models\Role::count() }}</h3>
                    </div>
                    <div class="icon-box bg-warning text-white">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="mt-4">

        <h5 class="mb-3">دسترسی سریع</h5>

        <div class="row g-3">

            @role('admin')
            <div class="col-md-3">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                    <div class="card quick-card p-3 text-center">
                        <i class="bi bi-people fs-2 text-primary"></i>
                        <div>مدیریت کاربران</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('admin.users.create') }}" class="text-decoration-none">
                    <div class="card quick-card p-3 text-center">
                        <i class="bi bi-person-plus fs-2 text-success"></i>
                        <div>افزودن کاربر</div>
                    </div>
                </a>
            </div>
            @endrole

            <div class="col-md-3">
                <a href="{{ route('task.index') }}" class="text-decoration-none">
                    <div class="card quick-card p-3 text-center">
                        <i class="bi bi-list-task fs-2 text-dark"></i>
                        <div>تسک‌ها</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('leaves.index') }}" class="text-decoration-none">
                    <div class="card quick-card p-3 text-center">
                        <i class="bi bi-calendar-x fs-2 text-danger"></i>
                        <div>مرخصی‌ها</div>
                    </div>
                </a>
            </div>

            <!-- ✅ حضور و غیاب کاربر -->
            <div class="col-md-3">
                <a href="{{ route('attendance.index') }}" class="text-decoration-none">
                    <div class="card quick-card p-3 text-center">
                        <i class="bi bi-clock-history fs-2 text-warning"></i>
                        <div>حضور و غیاب</div>
                    </div>
                </a>
            </div>

            <!-- ✅ گزارش حضور و غیاب ادمین -->
            @role('admin')
            <div class="col-md-3">
                <a href="{{ route('admin.attendances.index') }}" class="text-decoration-none">
                    <div class="card quick-card p-3 text-center">
                        <i class="bi bi-clipboard-data fs-2 text-info"></i>
                        <div>گزارش حضور و غیاب</div>
                    </div>
                </a>
            </div>
            @endrole
        </div>
    </div>

@endsection
