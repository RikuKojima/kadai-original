<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountsService
{
  ##ローカルUserと関連するSNSアカウントを作成または取得する
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $account = LinkedSocialAccounts::where('provider_name', $provider)
                   ->where('provider_id', $providerUser->getId())
                   ->first();

        if ($account) {
            //アカウントが存在するとき
            return $account->user;
        } else {
        #指定したアカウントはない場合
        #emailを元にもう一度探す
        $user = User::where('email', $providerUser->getEmail())->first();

        if (! $user) {
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name'  => $providerUser->getName(),
            ]);
        }

        $user->accounts()->create([
            'provider_id'   => $providerUser->getId(),
            'provider_name' => $provider,
        ]);

        return $user;

        }
    }
}
