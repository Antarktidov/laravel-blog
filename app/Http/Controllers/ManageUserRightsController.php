<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ManageUserRightsController extends Controller
{
    public function index(User $user)
    {
        return view('manage-user-rights', compact('user'));
    }

    public function store(User $user, Request $request) {
        $data = [
            'is_steward' => $request->has('is_steward'),
            'is_admin' => $request->has('is_admin'),
            'is_editor' => $request->has('is_editor'),
        ];

        $user->update($data);

        return 'Права участника изменены';
    }
}
