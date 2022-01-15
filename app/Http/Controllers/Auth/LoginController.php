<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Providers\RouteServiceProvider;
use App\Services\AuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Inertia\Inertia;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    private $authService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('guest')->except('logout');
        $this->authService = $authService;
    }

    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function authenticate(LoginFormRequest $request)
    {
        $validated_data = $request->validated();

        $response = $this->authService->authenticate($validated_data);

        if ($response['status'] === 'success') {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors($response['errors']);
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect('/');
    }
}
