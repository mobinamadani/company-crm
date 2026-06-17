@extends('layouts.app')

@section('title','ویرایش تسک')

@section('content')

    <style>
        .task-card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 6px 22px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .task-header {
            background: linear-gradient(135deg,#4f46e5,#06b6d4);
            color: #fff;
            padding: 18px 20px;
        }

        .form-label {
            font-weight: 500;
            font-size: 14px;
        }

        .form-control, .form-select {
            border-radius: 10px;
        }

        .user-box {
            max-height: 220px;
            overflow-y: auto;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 10px;
            background: #fafafa;
        }

        .form-check {
            padding: 8px 10px;
            border-radius: 8px;
            transition: .2s;
        }

        .form-check:hover {
            background: #f3f4f6;
        }

        .btn-submit {
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 500;
        }

        .btn-back {
            border-radius: 10px;
            padding: 10px 18px;
        }

        .hint {
            font-size: 12px;
            color: #6b7280;
        }
    </style>

    <div class="card task-card">

        <!-- HEADER -->
        <div class="task-header d-flex align-items-center gap-2">
            <i class=" fs-4"></i>
            <div>
                <h5 class="mb-0">ویرایش تسک</h5>
                <small>ویرایش اطلاعات و تخصیص کاربران</small>
            </div>
        </div>

        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('task.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">عنوان تسک</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $task->title) }}"
                           class="form-control">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">توضیحات</label>
                    <textarea name="text"
                              rows="4"
                              class="form-control">{{ old('text', $task->text) }}</textarea>
                </div>

                <!-- Date + Status -->
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label">تاریخ انجام</label>
                        <input type="date"
                               name="take_date"
                               value="{{ old('take_date', $task->take_date ? $task->take_date->format('Y-m-d') : '') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">وضعیت</label>
                        <select name="status" class="form-select">
                            <option value="pending" @selected($task->status == 'pending')>در انتظار</option>
                            <option value="in_progress" @selected($task->status == 'in_progress')>در حال انجام</option>
                            <option value="completed" @selected($task->status == 'completed')>تکمیل شده</option>
                        </select>
                    </div>

                </div>

                <!-- Users -->
                <div class="mb-3">
                    <label class="form-label">کاربران تسک</label>
                    <div class="hint mb-2">می‌تونی کاربران رو تغییر بدی</div>

                    <div class="user-box">

                        @foreach($users as $user)
                            <div class="form-check">
                                <input type="checkbox"
                                       name="users[]"
                                       value="{{ $user->id }}"
                                       class="form-check-input"
                                       id="user{{ $user->id }}"
                                    @checked(
                                         old('users')
                                             ? in_array($user->id, old('users'))
                                             : $task->users->contains($user->id)
                                    )>

                                <label class="form-check-label" for="user{{ $user->id }}">
                                    {{ $user->name }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('task.index') }}" class="btn btn-secondary btn-back">
                        بازگشت
                    </a>

                    <button type="submit" class="btn btn-success btn-submit">
                        <i class="bi bi-check-circle me-1"></i>
                        ذخیره تغییرات
                    </button>

                </div>

            </form>

        </div>
    </div>

@endsection
