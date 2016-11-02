<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Socialite;

class SocialAuthController extends Controller
{
    public function fbRedirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function fbHandleProviderCallback()
    {
        $this->sameShit('facebook');
        return Redirect::to('/');
    }

    public function googleRedirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleHandleProviderCallback()
    {
        $this->sameShit('google');
        return Redirect::to('/');
    }

    public function twitterRedirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterHandleProviderCallback()
    {
        $this->sameShit('twitter');
        return Redirect::to('/');
    }


    public function sameShit($sn)
    {
        try {
            $user = Socialite::driver($sn)->user();
        } catch (Exception $e) {
            return Redirect::to('auth/'.$sn);
        }

        $my_user = User::where('email', $user->email);
        if($my_user->count())
        {
            if($my_user->first()->password == null)
            {
                $authUser = $this->findOrCreateUser($user, $sn);
                Auth::login($authUser, true);
                return;
            }
            else
            {
                return Redirect::to('/login')->with('error', 'Already registered through email, please sign in through email');
            }
        }

        $authUser = $this->findOrCreateUser($user, $sn);
        Auth::login($authUser, true);
    }


    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $snUser $sn
     * @return User
     */
    private function findOrCreateUser($snUser, $sn)
    {
        if ($authUser = User::where(['social_network' => $sn, 'social_id' => $snUser->getid()])->first()) {
            return $authUser;
        }
        else
        {
            $user = new User();
            $user->name = $snUser->name;
            $user->email = $snUser->email;
            $user->social_network = $sn;
            $user->social_id = $snUser->id;
            $user->avatar = $snUser->avatar;

            return $user;
        }
    }
}
