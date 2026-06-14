@extends('layouts.app')

@section('title','ویرایش تسک')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header">
            <h5>ویرایش تسک</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('task.update', $task) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        عنوان
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $task->title) }}"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        توضیحات
                    </label>

                    <textarea
                        name="text"
                        rows="4"
                        class="form-control">{{ old('text', $task->text) }}</textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        تاریخ
                    </label>

                    <input
                        type="date"
                        name="take_date"
                        value="{{ old('take_date', $task->take_date ? $task->take_date->format('Y-m-d') : '') }}"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        وضعیت
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="pending"
                            @selected($task->status == 'pending')>

                            در انتظار

                        </option>

                        <option
                            value="in_progress"
                            @selected($task->status == 'in_progress')>

                            در حال انجام

                        </option>

                        <option
                            value="completed"
                            @selected($task->status == 'completed')>

                            تکمیل شده

                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        کاربران تسک
                    </label>

                    @foreach($users as $user)

                        <div class="form-check">

                            <input
                                type="checkbox"
                                name="users[]"
                                value="{{ $user->id }}"
                                class="form-check-input"
                                id="user{{ $user->id }}"

                                @checked(
                                    old('users')
                                        ? in_array($user->id, old('users'))
                                        : $task->users->contains($user->id)
                                )>

                            <label
                                class="form-check-label"
                                for="user{{ $user->id }}">

                                {{ $user->name }}

                            </label>

                        </div>

                    @endforeach

                </div>

                <button
                    type="submit"
                    class="btn btn-warning">

                    ویرایش تسک

                </button>

                <a
                    href="{{ route('task.index') }}"
                    class="btn btn-secondary">

                    بازگشت

                </a>

            </form>
        </div>
    </div>

@endsection
