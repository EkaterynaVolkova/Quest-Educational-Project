<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthFacebookController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {
        $SocialUser = Socialite::driver('facebook')->stateless()->user();

        $data = [
            'social_id' => $SocialUser->id,
            'name' => $SocialUser->name,
            'email' => $SocialUser->email,
            'avatar' => $SocialUser->avatar_original,
            'nickname' => $SocialUser->nickname,
            'gender' => $SocialUser->user['gender']
        ];

        $user = User::where('social_id', $data['social_id'])->first();
        if (is_null($user)) {
            $user = User::create($data);
            $user->save();
        }

        Auth::login($user, true);
        return redirect()->back();
    }
}
