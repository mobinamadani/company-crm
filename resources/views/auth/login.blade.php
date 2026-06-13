@extends('layouts.app')
@section('title', 'ورود')
@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">ورود کاربران</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf

                            <!-- Mobile -->
                            <div class="mb-3">
                                <label class="form-label">شماره موبایل</label>

                                <input
                                    type="text"
                                    name="mobile"
                                    class="form-control"
                                    value="{{ old('mobile') }}"
                                    placeholder="09121234567">
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">رمز عبور</label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control">
                            </div>

                            <!-- Remember -->
                            <div class="form-check mb-3">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    class="form-check-input"
                                    id="remember">

                                <label class="form-check-label" for="remember">
                                    مرا به خاطر بسپار
                                </label>

                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary w-100">
                                ورود
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
