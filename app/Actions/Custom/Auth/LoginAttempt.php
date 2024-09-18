<?php

namespace App\Actions\Custom\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
class LoginAttempt      
{
    public function __invoke(Request $request)
    {
        if (Fortify::username() === 'email') {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = User::join('employees', 'users.employee_id', '=', 'employees.id')
                ->where('users.username', $request->username)
                ->where('users.is_active', true)
                ->where('employees.is_active', true)->first();
        }
        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }   
    }
}