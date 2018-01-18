<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Closure;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $SocialUser = Socialite::driver('google')->stateless()->user();

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
        return redirect()->route('view quest');
    }
}
