<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $users], 200) : view("user.index", compact("users"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New User";
        return view('user.create', compact('title'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],


            ]
        );

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $request->input('phone'),
            'type' => $request->input('type'),
            'password' => Hash::make('password@123'),
        ]);
        return $request->wantsJson() ? new JsonResponse(["data" => $user], 201) : redirect(route('user.users.index'))->with('success', 'Your new User has been added successfully!');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return request()->wantsJson() ? new JsonResponse(["data" => $user], 200) :  view("user.users.show", compact("user"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = "Edit User";
        return view('user.create', compact('title', 'user'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $user], 200) : redirect(route('user.users.index'))->with('success', 'Your  user has been updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('user.users.index'))->with('success', 'Your user has been deleted successfully!');
        //
    }
}
