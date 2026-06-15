@extends('layouts.app')

@section('title','مرخصی‌ها')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h4>لیست مرخصی‌ها</h4>

        <a href="{{ route('leaves.create') }}" class="btn btn-primary">
            درخواست مرخصی
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
            <th>کاربر</th>
            <th>نوع</th>
            <th>تاریخ</th>
            <th>از ساعت</th>
            <th>تا ساعت</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
        </thead>

        <tbody>
        @foreach($leaves as $leave)
            <tr>

                <td>{{ $leave->user->name }}</td>

                <td>
                    {{ $leave->type == 'daily' ? 'روزانه' : 'ساعتی' }}
                </td>

                {{-- ✅ تاریخ --}}
                <td>
                    {{ $leave->shamsi_date }}
                </td>

                <td>{{ $leave->from_time ?? '-' }}</td>

                <td>{{ $leave->to_time ?? '-' }}</td>

                <td>
                    @if($leave->status == 'pending')
                        <span class="badge bg-warning">در انتظار</span>
                    @elseif($leave->status == 'approved')
                        <span class="badge bg-success">تایید</span>
                    @else
                        <span class="badge bg-danger">رد</span>
                    @endif
                </td>

                <td>
                    @role('admin')
                    <a href="{{ route('leaves.approve',$leave) }}" class="btn btn-success btn-sm">تایید</a>
                    <a href="{{ route('leaves.reject',$leave) }}" class="btn btn-danger btn-sm">رد</a>
                    @endrole
                </td>

            </tr>
        @endforeach
        </tbody>

    </table>

    {{ $leaves->links() }}

@endsection
