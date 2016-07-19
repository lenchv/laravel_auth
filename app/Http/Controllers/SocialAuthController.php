<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Socialite;
class SocialAuthController extends Controller
{
	protected $redirectPath = "/home";

    public function redirectToProvider(Request $request) {
    	return Socialite::driver("github")->redirect();
    }
	public function handleProviderCallback() {
		$socialUser = Socialite::driver("github")->user();
		$user = User::where(["email" => $socialUser->email])->first();
		if (is_null($user)) {
			$user = User::create([
				"name" => $socialUser->user['login'],
				"email" => $socialUser->email,
				]);
		}
		Auth::login($user);
		return redirect($this->redirectPath);
	}
}
