<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
//        return view('auth.login');
        return view('new.login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password' => $request->get('password')];
        }
        return ['phone' => $request->get('email'), 'password' => $request->get('password')];
    }

    public function redirectToProviderFB()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFB()
    {
        $provider = 'facebook';
        $user_info = Socialite::driver($provider)->user();
        $user = $this->createUser($user_info, $provider);
        auth()->login($user, true);
        return redirect()->to('/home');
    }

    public function redirectToProviderDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function handleProviderCallbackDiscord()
    {
        $provider = 'discord';
        $user_info = Socialite::driver($provider)->user();
        $user = $this->createUser($user_info, $provider);
        auth()->login($user, true);
        return redirect()->to('/home');
    }

    public function redirectToProviderGG()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGG()
    {
        $provider = 'google';
        $user_info = Socialite::driver($provider)->user();
        $user = $this->createUser($user_info, $provider);
        auth()->login($user, true);
        return redirect()->to('/home');
    }

    public function createUser($user_info, $provider)
    {
//        Chỉnh phone và email khác null để tránh lúc query bị dính vào row có giá trị null lại thành bắt sai row
        $user_mail = isset($user_info->email) ? $user_info->email : 'not_have_email';
        $user_phone = isset($user_info->phone) ? $user_info->phone : 'not_have_phone';
        $user = User::where('provider_id', $user_info->id)->orWhere('email', $user_mail)->orWhere('phone', $user_phone)->first();
        $user = User::where('provider_id', $user_info->id)->orWhere('email', $user_mail)->first();
        if ($user_mail == 'not_have_email') {
            $user_mail = null;
        }
        if ($user_phone == 'not_have_phone') {
            $user_phone = null;
        }
       if (!$user) {
            $user = User::create([
                'name' => $user_info->name,
                'email' => $user_mail,
                'phone' => $user_phone,
                'provider' => $provider,
                'credit' => 0,
                'avatar' => $user_info->avatar,
//                'wallet' => RandomWalletCode(),
                'provider_id' => $user_info->id,
                'password' => Hash::make('matkhaumacdinh77777'),
            ]);
        } else {
            if ($user_info->email === 'khanhpv2@rikkeisoft.com') {
                dd($user);
            }
            $user->avatar = $user_info->avatar;
            $user->save();
        }
        return $user;
    }
}
