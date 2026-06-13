@extends('layouts.app')
@section('title', 'کاربران')
@section('content')
    <h2>لیست کاربران</h2>
    <a href="{{route('admin.users.create')}}" class="btn btn-primary"><i class="bi bi-plus-circle "></i> افزودن کاربر</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}

        </div>
    @endif

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr class="fw-bold fs-6">
                    <td>#</td>
                    <td>نام</td>
                    <td>موبایل</td>
                    <td>نقش</td>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->roles->pluck('name')->join(',')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}

    </div>
@endsection
