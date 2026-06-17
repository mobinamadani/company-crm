@extends('layouts.app')
@section('title','درخواست مرخصی')
@section('content')

    <style>
        .leave-card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .leave-header {
            background: linear-gradient(135deg,#6366f1,#3b82f6);
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

        .btn-submit {
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 500;
        }
    </style>

    <div class="card leave-card">

        <!-- HEADER -->
        <div class="leave-header d-flex align-items-center gap-2">
            <i class="fs-4"></i>
            <div>
                <h5 class="mb-0">ثبت درخواست مرخصی</h5>
                <small>فرم ثبت درخواست جدید</small>
            </div>
        </div>

        <div class="card-body p-4">

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('leaves.store') }}">
                @csrf

                {{-- Type --}}
                <div class="mb-3">
                    <label class="form-label">نوع مرخصی</label>
                    <select name="type" class="form-select">
                        <option value="daily">روزانه</option>
                        <option value="hourly">ساعتی</option>
                    </select>
                </div>

                {{-- Date --}}
                <div class="mb-3">
                    <label class="form-label">تاریخ مرخصی</label>

                    <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>

                        <input
                            type="text"
                            id="leave_date_picker"
                            class="form-control"
                            placeholder="انتخاب تاریخ"
                            autocomplete="off"
                        >

                        <input type="hidden" name="leave_date" id="leave_date">
                    </div>
                </div>

                {{-- Time --}}
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label">از ساعت</label>
                        <input type="time" name="from_time" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">تا ساعت</label>
                        <input type="time" name="to_time" class="form-control">
                    </div>

                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">توضیحات</label>
                    <textarea name="description" class="form-control" rows="4"
                              placeholder="توضیح کوتاه درباره مرخصی..."></textarea>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success btn-submit">
                        <i class="bi bi-check-circle me-1"></i>
                        ثبت درخواست
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(function () {

            $('#leave_date_picker').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#leave_date',
                altFormat: 'YYYY-MM-DD',
                observer: true,
                initialValue: false
            });

        });
    </script>
@endpush
