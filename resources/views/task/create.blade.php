@extends('layouts.app')
@section('title','ثبت تسک')
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
                <h5 class="mb-0">ثبت تسک جدید</h5>
                <small>ایجاد و تخصیص وظیفه به کاربران</small>
            </div>
        </div>

        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('task.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">عنوان تسک</label>
                    <input type="text" name="title" class="form-control" placeholder="مثلاً: طراحی داشبورد">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">توضیحات</label>
                    <textarea name="text" rows="4" class="form-control"
                              placeholder="توضیح کامل درباره تسک..."></textarea>
                </div>

                <!-- Date + Status -->
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label">تاریخ انجام</label>
                        <input type="date" name="take_date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">وضعیت</label>
                        <select name="status" class="form-select">
                            <option value="pending">در انتظار</option>
                            <option value="in_progress">در حال انجام</option>
                            <option value="completed">تکمیل شده</option>
                        </select>
                    </div>

                </div>

                <!-- Users -->
                <div class="mb-3">
                    <label class="form-label">تخصیص به کاربران</label>
                    <div class="hint mb-2">می‌تونی چند کاربر انتخاب کنی</div>

                    <div class="user-box">

                        @foreach($user as $user)
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    name="users[]"
                                    value="{{ $user->id }}"
                                    class="form-check-input"
                                    id="user{{ $user->id }}">

                                <label class="form-check-label" for="user{{ $user->id }}">
                                    {{ $user->name }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success btn-submit">
                        <i class="bi bi-check-circle me-1"></i>
                        ثبت تسک
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
