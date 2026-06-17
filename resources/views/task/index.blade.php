@extends('layouts.app')
@section('title','لیست تسک ها')
@section('content')

    <style>
        .task-wrapper {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 22px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .task-header {
            background: linear-gradient(135deg,#4f46e5,#06b6d4);
            color: #fff;
            padding: 16px 18px;
        }

        .table thead {
            background: #f8fafc;
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

        .btn-sm {
            border-radius: 8px;
        }

        .action-btns .btn {
            margin-left: 4px;
        }

    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-0">لیست تسک‌ها</h4>
            <small class="text-muted">مدیریت و بررسی وظایف</small>
        </div>

        <a href="{{ route('task.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            ثبت تسک
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="task-wrapper">

        <div class="task-header d-flex justify-content-between align-items-center">
            <span>تسک‌ها</span>
            <i class="bi bi-list-task"></i>
        </div>

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>
                <tr>
                    <th>عنوان</th>
                    <th>ایجاد کننده</th>
                    <th>اعضا</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>

                @forelse($tasks as $task)

                    <tr>

                        <td class="fw-bold">{{ $task->title }}</td>

                        <td>{{ $task->creator->name }}</td>

                        <td class="text-muted small">
                            {{ $task->users->pluck('name')->join(' , ') }}
                        </td>

                        <td>{{ $task->shamsi_date }}</td>

                        <td>

                            @if($task->status == 'pending')
                                <span class="badge-soft status-pending">در انتظار</span>

                            @elseif($task->status == 'in_progress')
                                <span class="badge-soft status-progress">در حال انجام</span>

                            @else
                                <span class="badge-soft status-done">تکمیل شده</span>
                            @endif

                        </td>

                        <td class="action-btns">

                            <a href="{{ route('task.show', $task) }}"
                               class="btn btn-info btn-sm">
                                مشاهده
                            </a>

                            <a href="{{ route('task.edit',$task) }}"
                               class="btn btn-warning btn-sm">
                                ویرایش
                            </a>

                            <form action="{{ route('task.destroy',$task) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    حذف
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            هیچ تسکی یافت نشد
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-3">
        {{ $tasks->links() }}
    </div>

@endsection
