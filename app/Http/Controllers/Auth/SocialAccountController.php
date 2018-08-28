<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
class SocialAccountController extends Controller
{
    //

    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    #認証終了後の作業
    public function handleProviderCallback(\App\SocialAccountsService $accountService, $provider) {
      try {
           $user = \Socialite::with($provider)->user();
       } catch (\Exception $e) {
         #エラー発生
          print('エラー発生');
           return redirect('/login');
       }

       $authUser = $accountService->findOrCreate(
           $user,
           $provider
       );
       #ユーザをログインさせる
       auth()->login($authUser, true);

       return redirect()->to('/');
   }

}
