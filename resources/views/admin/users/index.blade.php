@extends('layouts.app')
@section('title', 'کاربران')
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-0 fw-bold">لیست کاربران</h3>
            <small class="text-muted">مدیریت کاربران سیستم</small>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="btn btn-primary shadow-sm rounded-3">

            <i class="bi bi-plus-circle me-1"></i>
            افزودن کاربر

        </a>

    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                    <tr class="fw-bold text-muted">
                        <th>#</th>
                        <th>نام</th>
                        <th>موبایل</th>
                        <th>نقش</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td class="fw-bold text-muted">
                                {{ $user->id }}
                            </td>

                            <td class="fw-semibold">
                                <i class="bi bi-person-circle text-primary me-1"></i>
                                {{ $user->name }}
                            </td>

                            <td>
                                <span class="text-dark">
                                    {{ $user->mobile }}
                                </span>
                            </td>

                            <td>
                                @if($user->roles->count())
                                    <span class="badge bg-primary">
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        بدون نقش
                                    </span>
                                @endif
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                هیچ کاربری یافت نشد
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $users->links() }}
    </div>

@endsection
