@extends('layouts.app')
@section('title', 'افزودن کاربر')
@section('content')

<div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">افزودن کاربر</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{route('admin.users.store')}}">
                @csrf

                <!--Name-->
                <div class="mb-3">
                    <label class="form-lable">نام</label>

                    <input type="text" name="name" class="form-control">
                </div>

                <!--Mobile-->
                <div class="mb-3">
                    <label class="form-lable">موبایل</label>

                    <input type="text" name="mobile" class="form-control">
                </div>

                <!--Password-->
                <div class="mb-3">
                    <label class="form-lable">رمزعبور</label>

                    <input type="password" name="password" class="form-control">
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label class="form-label"> نقش </label>
                    <select name="role" class="form-select">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"> {{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-success"> ذخیره کاربر </button>

            </form>
        </div>
    </div>
</div>

@endsection
