@extends('layouts.app')
@section('title', 'افزودن کاربر')
@section('content')

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <!-- Card -->
            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-4">

                    <!-- Header -->
                    <div class="d-flex align-items-center justify-content-between mb-4">

                        <div>
                            <h4 class="mb-1 fw-bold">افزودن کاربر جدید</h4>
                            <small class="text-muted">اطلاعات کاربر را وارد کنید</small>
                        </div>

                        <div class="fs-2 text-primary">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>

                    </div>

                    <!-- Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">نام کامل</label>
                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg"
                                   placeholder="مثلا: علی رضایی">
                        </div>

                        <!-- Mobile -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">شماره موبایل</label>
                            <input type="text"
                                   name="mobile"
                                   class="form-control form-control-lg"
                                   placeholder="09xxxxxxxxx">
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">رمز عبور</label>
                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg"
                                   placeholder="رمز قوی وارد کنید">
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">نقش کاربر</label>

                            <select name="role"
                                    class="form-select form-select-lg">

                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                                class="btn btn-success btn-lg w-100 rounded-3 shadow-sm">

                            <i class="bi bi-check-circle me-1"></i>
                            ذخیره کاربر

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
