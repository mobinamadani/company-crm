@extends('layouts.app')

@section('title', 'حضور و غیاب')

@section('content')

    <div class="card">

        <div class="card-header">
            حضور و غیاب امروز
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($todayAttendance)

                <p>
                    <strong>ورود:</strong>
                    {{ $todayAttendance->check_in }}
                </p>

                <p>
                    <strong>خروج:</strong>
                    {{ $todayAttendance->check_out ?? 'ثبت نشده' }}
                </p>

                <p>
                    <strong>وضعیت:</strong>
                    {{ $todayAttendance->status }}
                </p>

            @endif

            <form action="{{ route('attendance.checkin') }}" method="POST">

                @csrf

                <button class="btn btn-success">

                    ثبت ورود

                </button>

            </form>

            <hr>

            <form action="{{ route('attendance.checkout') }}" method="POST">

                @csrf

                <button class="btn btn-danger">

                    ثبت خروج

                </button>

            </form>

        </div>

    </div>

@endsection
