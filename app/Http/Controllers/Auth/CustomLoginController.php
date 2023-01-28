<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\API\UserController;

class CustomLoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function getCredentials()
    {
        return view('auth.credentials');
    }

    public function checkCredentials(Request $request)
    {
        $request->merge(['phone' => preg_replace('/[^0-9]/', '', $request->phone)]);
        $request->validate(
            ['phone' => 'required|regex:/^\+?[78][-\(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/',],
            [
                'phone.required' => 'Введите номер телефона',
                'phone.regex' => 'Формат телефона некорректен',
            ]
        );

        return (new UserController())->getCredentialsHandler($request->phone);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'remember' => 'nullable'
        ], [
                'login.required' => 'Введите логин',
                'password.required' => 'Введите пароль',
            ]);

        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            // update new User with data and user_ID
            $userController = new UserController();
            if (!$userController->updateUser()) {
                Session::flush();
                Auth::logout();

                return redirect("login")->withErrors(['login' => 'Произошла ошибка!Обратитесь к менеджеру']);
            }

            $userController->getClinics();
            $userController->getDoctors();
            $userController->getAllServices();
            $userController->getServices();
            $userController->getPayments();
            $userController->getAppointments();

            $user = Auth::user();
            $user->login_at = time();
            $user->save();

            return redirect()->route('profile.index')
                ->withSuccess('Вход...');

        }

        return redirect("login")->withErrors(['login' => 'Логин или пароль неверны']);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
