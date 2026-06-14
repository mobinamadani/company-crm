@extends('layouts.app')

@section('title','لیست تسک ها')

@section('content')

    <div class="d-flex justify-content-between mb-3">

        <h4>لیست تسک ها</h4>

        <a
            href="{{ route('task.create') }}"
            class="btn btn-primary">

            ثبت تسک

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <table class="table table-bordered">

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

        @foreach($tasks as $task)

            <tr>

                <td>{{ $task->title }}</td>

                <td>{{ $task->creator->name }}</td>

                <td>

                    {{ $task->users->pluck('name')->join(' , ') }}

                </td>

                <td>{{ $task->shamsi_date }}</td>

                <td>{{ $task->status }}</td>

                <td>

                    <a
                        href="{{ route('task.show', $task) }}"
                        class="btn btn-info btn-sm">

                        مشاهده

                    </a>

                    <a
                        href="{{ route('task.edit',$task) }}"
                        class="btn btn-warning btn-sm">

                        ویرایش

                    </a>

                    <form
                        action="{{ route('task.destroy',$task) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm">

                            حذف

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    {{ $tasks->links() }}

@endsection
