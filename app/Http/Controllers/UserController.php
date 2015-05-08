<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display an user profile.
	 *
	 * @return Response
	 */
	public function showProfile()
	{
		$user = Auth::user();
		return view('user.profile', compact('user'));
	}

	public function updateProfile(Request $request) {
		$user = Auth::user();
		$data = [
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'email' => $request->input('email')
		];
		$rules = [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,' . $user->id
		];
		if($request->has('password')) {
			$data['password'] = bcrypt($request->input('password'));
			$rules['password'] = 'confirmed|min:6';
		}
		$this->validate($request, $rules);
		$user->update($data);
		return redirect('/')->with([
			'flash_msg' => 'Данные пользователя обновлены',
			'flash_type' => 'success'
		]);
	}
}
