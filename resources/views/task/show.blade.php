@extends('layouts.app')
@section('title', 'جزئیات تسک')
@section('content')
    <style>
        .task-show-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 22px rgba(0,0,0,0.06);
        }

        .task-show-header {
            background: linear-gradient(135deg,#4f46e5,#06b6d4);
            color: #fff;
            padding: 18px;
        }

        .info-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 10px 14px;
            margin-bottom: 10px;
        }

        .label {
            font-size: 13px;
            color: #6b7280;
        }

        .value {
            font-weight: 600;
        }

        .desc-box {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 14px;
            min-height: 80px;
            line-height: 1.8;
        }

        .badge-soft {
            padding: 6px 10px;
            border-radius: 10px;
            font-size: 12px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-progress {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-done {
            background: #dcfce7;
            color: #166534;
        }

        .user-list li {
            padding: 4px 0;
        }
    </style>

    <div class="card task-show-card">

        <!-- HEADER -->
        <div class="task-show-header d-flex justify-content-between align-items-center">

            <div>
                <h4 class="mb-0">{{ $task->title }}</h4>
                <small class="text-white-50">جزئیات کامل تسک</small>
            </div>

            <i class="bi bi-card-checklist fs-3"></i>

        </div>

        <div class="card-body p-4">

            <!-- INFO GRID -->
            <div class="row g-3 mb-3">

                <div class="col-md-4">
                    <div class="info-box">
                        <div class="label">ایجاد کننده</div>
                        <div class="value">{{ $task->creator->name }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-box">
                        <div class="label">تاریخ</div>
                        <div class="value">{{ $task->shamsi_date }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info-box">
                        <div class="label">وضعیت</div>

                        <div class="value">

                            @if($task->status == 'pending')
                                <span class="badge-soft status-pending">در انتظار</span>

                            @elseif($task->status == 'in_progress')
                                <span class="badge-soft status-progress">در حال انجام</span>

                            @else
                                <span class="badge-soft status-done">تکمیل شده</span>
                            @endif

                        </div>

                    </div>
                </div>

            </div>

            <!-- USERS -->
            <div class="mb-3">

                <div class="label mb-2">اعضای تسک</div>

                <ul class="user-list">
                    @foreach($task->users as $user)
                        <li>
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $user->name }}
                        </li>
                    @endforeach
                </ul>

            </div>

            <!-- DESCRIPTION -->
            <div class="mb-3">

                <div class="label mb-2">توضیحات</div>

                <div class="desc-box">
                    {{ $task->text ?? 'توضیحی ثبت نشده است' }}
                </div>

            </div>

            <!-- ACTION -->
            <a href="{{ route('task.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-right me-1"></i>
                بازگشت
            </a>

        </div>

    </div>

@endsection
