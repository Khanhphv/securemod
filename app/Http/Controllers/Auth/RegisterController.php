<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Option;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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
    protected function validator(Request $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
    }

    public function checkexist(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'min:6|required_with:password_confirmation|same:repassword',
            'repassword' => 'min:6'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => [
                        $validate->errors()->first()
                    ]
                ]
            ], 422);
        } else {    
            $currentref = $request['refcode'];
            if($currentref == NULL){
                return $this->create([
                    'name' => $request['name'],
                    'email' => $request['email'], 
                    'password'  => $request['password']
                ]);
            }else{
                return $this->create([
                    'name' => $request['name'],
                    'email' => $request['email'], 
                    'password'  => $request['password'],
                    'ref_user_id' => $request['refcode']
                ]);
            }
        }
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
        $user->name = $data['name'];
        $user->email = $data['email'];
        // $user->phone = $data['phone'];
        $user->phone = date("dmYhis");
        $user->ref_user_id = 0;
        $option = Option::where('option', 'commission')->first();
        if ($option == null || $option->value == null) {
            $commission = 0;
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
        $user->user_ref_count = 0;
        $user->user_debt = 0;
        $user->password = Hash::make($data['password']);
        $user->type = User::DEFAULT_TYPE;
        $user->save();

        return $user;
    }
}
