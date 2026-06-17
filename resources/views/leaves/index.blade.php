@extends('layouts.app')
@section('title','مرخصی‌ها')
@section('content')

    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h4 {
            margin: 0;
            font-weight: bold;
        }

        .card-box {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .table thead {
            background: #f8fafc;
        }

        .badge-status {
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-soft {
            border-radius: 10px;
        }
    </style>

    <div class="page-header">

        <h4> لیست مرخصی‌ها</h4>

        <a href="{{ route('leaves.create') }}" class="btn btn-primary btn-soft">
            + درخواست مرخصی
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-box">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>
                <tr>
                    <th>کاربر</th>
                    <th>نوع</th>
                    <th>تاریخ</th>
                    <th>از</th>
                    <th>تا</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>

                @forelse($leaves as $leave)

                    <tr>

                        <td class="fw-bold">
                            {{ $leave->user->name }}
                        </td>

                        <td>
                        <span class="text-muted">
                            {{ $leave->type == 'daily' ? 'روزانه' : 'ساعتی' }}
                        </span>
                        </td>

                        <td>
                            {{ $leave->shamsi_date }}
                        </td>

                        <td>{{ $leave->from_time ?? '-' }}</td>
                        <td>{{ $leave->to_time ?? '-' }}</td>

                        <td>

                            @if($leave->status == 'pending')
                                <span class="badge-status status-pending">در انتظار</span>

                            @elseif($leave->status == 'approved')
                                <span class="badge-status status-approved">تایید شده</span>

                            @else
                                <span class="badge-status status-rejected">رد شده</span>
                            @endif

                        </td>

                        <td>

                            @role('admin')

                            <a href="{{ route('leaves.approve',$leave) }}"
                               class="btn btn-success btn-sm btn-soft">
                                تایید
                            </a>

                            <a href="{{ route('leaves.reject',$leave) }}"
                               class="btn btn-danger btn-sm btn-soft">
                                رد
                            </a>

                            @endrole

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            هیچ مرخصی‌ای ثبت نشده
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-3">
        {{ $leaves->links() }}
    </div>

@endsection
