@extends('layouts.app')

@section('title', 'جزئیات تسک')

@section('content')

    <div class="card shadow-sm">

        <div class="card-header">

            <h4 class="mb-0">

                {{ $task->title }}

            </h4>

        </div>

        <div class="card-body">

            <div class="mb-3">

                <strong>ایجاد کننده:</strong>

                {{ $task->creator->name }}

            </div>

            <div class="mb-3">

                <strong>تاریخ:</strong>

                {{ $task->shamsi_date }}
            </div>

            <div class="mb-3">

                <strong>وضعیت:</strong>

                @if($task->status == 'pending')

                    <span class="badge bg-secondary">
                    در انتظار
                </span>

                @elseif($task->status == 'in_progress')

                    <span class="badge bg-warning">
                    در حال انجام
                </span>

                @else

                    <span class="badge bg-success">
                    تکمیل شده
                </span>

                @endif

            </div>

            <div class="mb-3">

                <strong>اعضای تسک:</strong>

                <ul class="mt-2">

                    @foreach($task->users as $user)

                        <li>
                            {{ $user->name }}
                        </li>

                    @endforeach

                </ul>

            </div>

            <div class="mb-3">

                <strong>توضیحات:</strong>

                <div class="border rounded p-3 mt-2">

                    {{ $task->text ?? 'توضیحی ثبت نشده است' }}

                </div>

            </div>

            <a
                href="{{ route('task.index') }}"
                class="btn btn-secondary">

                بازگشت

            </a>

        </div>

    </div>

@endsection
