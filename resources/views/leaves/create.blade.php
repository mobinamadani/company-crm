@extends('layouts.app')

@section('title','درخواست مرخصی')

@section('content')

    <div class="card">

        <div class="card-header">
            <h5>ثبت مرخصی</h5>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('leaves.store') }}">
                @csrf

                {{-- نوع مرخصی --}}
                <div class="mb-3">
                    <label class="form-label">نوع مرخصی</label>

                    <select name="type" class="form-select">
                        <option value="daily">روزانه</option>
                        <option value="hourly">ساعتی</option>
                    </select>
                </div>

                {{-- تاریخ شمسی --}}
                <div class="mb-3">
                    <label class="form-label">تاریخ</label>

                    <input
                        type="text"
                        id="leave_date_picker"
                        class="form-control"
                        autocomplete="off"
                    >

                    <input
                        type="hidden"
                        name="leave_date"
                        id="leave_date"
                    >
                </div>

                {{-- ساعت‌ها --}}
                <div class="row mb-3">

                    <div class="col">
                        <label class="form-label">از ساعت</label>
                        <input type="time" name="from_time" class="form-control">
                    </div>

                    <div class="col">
                        <label class="form-label">تا ساعت</label>
                        <input type="time" name="to_time" class="form-control">
                    </div>

                </div>

                {{-- توضیحات --}}
                <div class="mb-3">
                    <label class="form-label">توضیحات</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <button class="btn btn-success">
                    ثبت مرخصی
                </button>

            </form>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function () {

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
