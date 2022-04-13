<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Option;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function showRegistrationForm()
    {
        return redirect('/login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User();
//        $user->name = $data['name'];
        $user->email = $data['email'];
        // $user->phone = $data['phone'];
//        $user->phone = $data['email'];
        $user->ref_user_id = null;
        $option = Option::where('option', 'commission')->first();
        if ($option == null || $option->value == null) {
            $commission = 3;
        } else
            $commission = $option->value;
        $user->user_ref_commission = $commission;
        if (isset($data['ref_user_id']) && $data['ref_user_id'] !== null) {
            $refUser = User::where('id', $data['ref_user_id'])->first();
            if ($refUser != null) {
                if ($refUser->user_ref_count > 0) {
                    $refUser->user_ref_count = $refUser->user_ref_count - 1;
                    $refUser->save();

                    $user->ref_user_id = $data['ref_user_id'];
                }
            }
        }
        $user->user_ref_count = 999;
        $user->user_debt = 0;
        $user->password = Hash::make($data['password']);
        $user->type = User::DEFAULT_TYPE;
        $user->save();

        return $user;
    }
}
