<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = Users::get();

        return view('admin.settings.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.settings.users.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $request->input('email'),
                'password' => 'required',
            ],
            [
                'name.required' => 'Необходимо ввести имя пользователя',
                'email.required' => 'Необходимо ввести адрес электронной почты',
                'email.unique' => 'Указанный адрес электронной почты уже зарегистрирован',
                'password.required' => 'Необходимо ввести пароль',
            ]
        );

        $user = new Users();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        flash('Запись добавлена')->success();

        return redirect(route('settings.users.index'));
    }

    public function edit($user_id)
    {
        $user = Users::find($user_id);

        return view('admin.settings.users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $request->user,
            ],
            [
                'name.required' => 'Необходимо ввести имя пользователя',
                'email.required' => 'Необходимо ввести адрес электронной почты',
                'email.unique' => 'Указанный адрес электронной почты уже зарегистрирован',
            ]
        );

        $user = Users::find($request->user);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        flash('Запись обновлена')->success();

        return redirect(route('settings.users.show', $user->id));
    }

    public function show(Request $request)
    {
        $user = Users::find($request->user);

        return view('admin.settings.users.show', compact('user'));
    }
}
