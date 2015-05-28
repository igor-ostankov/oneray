<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\GuestTokenRepository;

use App\Workspace;
use App\User;
use Illuminate\Http\Request;
use Mail;
use Session;
use Auth;

class WorkspaceController extends Controller {

	public function signIn(Request $request)
	{
		if($request->method() == 'POST') {
			$this->validate($request, [
				'workspace' => 'alpha_num|exists:workspaces,domain_prefix'
			]);
			return redirect()->route('workspace.home', ['workspace' => $request->input('workspace')]);
		}
		return view('workspace.signin');
	}

	public function createToken(Request $request) {
		if($request->method() == 'POST') {
			$this->validate($request, [
				'email' => 'required|email',
				'workspace' => 'required|alpha_num|unique:workspaces,domain_prefix'
			]);
			$email = $request->get('email');
			$workspace = new Workspace();
			$workspace->id = 0;
			$workspace->domain_prefix = $request->get('workspace');
			$tokenRepository = new GuestTokenRepository($workspace);
			$token = $tokenRepository->create($email);
			Mail::send('emails.workspace.emailConfirmation', compact('token'), function($message) use ($email) {
				$message->to($email);
			});
			return redirect('create/email')->with('email', $email);
		}
		return view('workspace.create.email');
	}

	public function createMailSent() {
		$email = Session::get('email');
		if(!$email)
			return redirect('/');
		return view('workspace.create.checkEmail', ['email' => $email]);
	}

	public function create(Request $request) {
		$token = $request->route('token');
		$workspace = new Workspace;
		$workspace->id = 0;
		$tokenRepository = new GuestTokenRepository($workspace);
		if(!$tokenRepository->exists($token))
			abort(404);

		$workspaceDomainPrefix = $tokenRepository->getWorkspaceDomainPrefix($token);
		$email = $tokenRepository->getEmail($token);
		$user = User::where(['email' => $email])->first();
		$userExists = is_object($user);

		if($request->getMethod() == 'POST') {
			$rules = [
				'workspace_name' => ['required','regex:/^[\w\pL\-\s]*$/u']
			];
			if(!$userExists) {
				$rules = array_merge($rules, [
					'first_name' => 'required|max:255',
					'last_name' => 'required|max:255',
					'password' => 'required|confirmed|min:6',
				]);
			}
			$this->validate($request, $rules);

			if(!$userExists) {
				$user = new User;
				$user->first_name = $request->get('first_name');
				$user->last_name = $request->get('last_name');
				$user->email = $email;
				$user->password = bcrypt($request->get('password'));
				$user->save();
			}

			$workspace = new Workspace;
			$workspace->name = $request->get('workspace_name');
			$workspace->domain_prefix = $workspaceDomainPrefix;
			$workspace->save();

			$user->workspaces()->attach($workspace->id);
			Auth::login($user);
			$tokenRepository->delete($token);
			return redirect()->route('workspace.home', [
				'workspace' => $workspace->domain_prefix
			]);
		}

		return view('workspace.create.create', [
			'workspaceDomainPrefix' => $workspaceDomainPrefix,
			'userExists' => $userExists
		]);
	}

}
