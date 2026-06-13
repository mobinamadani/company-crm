<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
           'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'کاربر ساخته شد');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
           'name' => 'required',
           'mobile' => 'required|unique:users,mobile,' . $user->id,
           'role' => 'required'
        ]);

        $user->update([
           'name' => $request->name,
           'mobile' => $request->mobile,
        ]);

        $user->syncRoles([$request->role]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'کاربر آپدیت شد');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'کاربر حذف شد');
    }
}
