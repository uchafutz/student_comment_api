<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\Student\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class LoginApiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate(['reg_id' => "required", "password" => "required"]);
        $credentials = $request->only('reg_id', 'password');
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken(Random::generate());
            $user = Student::find(Auth::id());
            $user->load(["users", "accademics", "courses.departments"]);
            if (request()->wantsJson()) {
                return response([
                    'token' => $token->plainTextToken,
                    'student' => $user,
                ], 200);
            }
        } else {
            return response([
                'data' => 'Invalid credentials'
            ], 400);
        }
    } //

}
