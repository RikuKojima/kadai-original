<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\EmailVarification;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;
use Mail;
use Carbon\Carbon;


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
    protected $redirectTo = '/questions/create';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function pre_check(Request $request) {
        $this->validator($request->all())->validate();
        $request->flashOnly('email');

        $bridge_request = $request->all();
        $bridge_request['password_mask'] = "*****";

        return view('auth.register_check')->with($bridge_request);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_valify_token' => base64_encode($data['email']),
        ]);

        $email = new EmailVarification($user);

        Mail::to($user->email)->send($email);

        return $user;
    }

    public function register(Request $request) {
        event(new Registered($user = $this->create($request->all())));

        return view('auth.registered');
    }

    public function showForm($email_token) {
        //使用可能なトークンか
        if(!User::where('email_valify_token', $email_token)->exists()){
            return view('auth.main.register')->with('message', '無効なトークンです');
        }else{
            $user = User::where('email_valify_token',$email_token)->first();
            //定数で指定したステータスで場合分け
            if($user->status == config('const.USER_STATUS.REGISTER')){
                logger('status'. $user->status);
                return view('auth.main.register')->with('message','すでに本登録されています。ログインして完了してください。');
            }

            //ユーザステータス更新clear必須
            $user->status = config('const.USER_STATUS.REGISTER');
        
            //ライブラリcarbon::now()は標準時刻
            if($user->save()) {
                return view('auth.main.register',compact('email_token'));

            }else{
                return view('auth.main.register')->with('message', 'メール認証に失敗しました。再度メールからリンクをクリックしてください。');
            }
        }
    }

    //確認画面の追加

    public function mainCheck(Request $request){
        $request->validate([
            'name' => 'equired|string',
            'name_pronunciation' => 'required|string',
            'birth_year' => 'required|numeric',
            'birth_month' => 'required|numeric', 
            'birth_day' => 'required|numeric',

        ]);

        $email_token = $request->email_token;


    $user = new User();
    $user->name = $request->name;
    $user->name_pronunciation = $request->name_pronunciation;
    $user->birth_year = $request->birth_year;
    $user->birth_month = $request->birth_month;
    $user->birth_day = $request->birth_day;

    return view('auth.main.register.check', compact('user', 'email_token'));
    }

    public function mainRegister(Request $request) {
        $user = User::where('email_varify_token',$request->email_token)->first();
        $user->status = config('const.USER.STATUS.REGISTER');
        $user = new User();
        $user->name = $request->name;
        $user->name_pronunciation = $request->name_pronunciation;
        $user->birth_year = $request->birth_year;
        $user->birth_month = $request->birth_month;
        $user->birth_day = $request->birth_day;
        $user->save();
        return view('auth.main.registered');
    }
}
