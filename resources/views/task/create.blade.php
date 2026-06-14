@extends('layouts.app')

@section('title','ثبت تسک')

@section('content')

    <div class="card shadow-sm">

        <div class="card-header">
            <h5>ثبت تسک جدید</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('task.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">عنوان</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">توضیحات</label>

                    <textarea
                        name="text"
                        rows="4"
                        class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">تاریخ</label>

                    <input
                        type="date"
                        name="take_date"
                        class="form-control">
                </div>

                <div class="mb-3">

                    <label class="form-label">
                        وضعیت
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="pending">
                            در انتظار
                        </option>

                        <option value="in_progress">
                            در حال انجام
                        </option>

                        <option value="completed">
                            تکمیل شده
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        کاربران تسک
                    </label>

                    @foreach($user as $user)

                        <div class="form-check">

                            <input
                                type="checkbox"
                                name="users[]"
                                value="{{ $user->id }}"
                                class="form-check-input"
                                id="user{{ $user->id }}">

                            <label
                                class="form-check-label"
                                for="user{{ $user->id }}">

                                {{ $user->name }}

                            </label>

                        </div>

                    @endforeach

                </div>

                <button
                    class="btn btn-success">

                    ثبت تسک

                </button>

            </form>

        </div>

    </div>

@endsection
