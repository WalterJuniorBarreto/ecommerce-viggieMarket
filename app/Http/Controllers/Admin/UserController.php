<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        
        return back()->with('success', 'Estado del usuario actualizado');
    }

    public function makeAdmin(User $user)
    {
        $user->update(['is_admin' => true]);
        return back()->with('success', 'Usuario convertido en administrador');
    }

    public function removeAdmin(User $user)
    {
        // No permitir desactivar el admin actual
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes desactivar tu propio rol de administrador');
        }

        $user->update(['is_admin' => false]);
        return back()->with('success', 'Usuario removido como administrador');
    }
}