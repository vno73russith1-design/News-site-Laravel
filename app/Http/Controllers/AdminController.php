<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $texts = Text::with(['category', 'author'])->orderByDesc('created_at')->get();
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('admin', compact('texts', 'users', 'roles'));
    }

    public function block(Text $text)
    {
        $text->update(['is_blocked' => !$text->is_blocked]);
        return back();
    }

    public function destroy(Text $text)
    {
        $text->delete();
        return back();
    }

    public function changeRole(Request $request, User $user)
    {
        $request->validate(['role_id' => 'required|exists:roles,id']);
        $user->update(['role_id' => $request->role_id]);
        return back();
    }
}