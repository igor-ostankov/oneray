<?php namespace App\Services;

use App;
use Illuminate\Contracts\Auth\UserProvider;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Auth\Guard as AuthGuard;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Guard extends AuthGuard {

	protected $workspace;

	public function __construct(UserProvider $provider,
								SessionInterface $session,
								Request $request = null)
	{
		$this->session = $session;
		$this->request = $request;
		$this->provider = $provider;
		$this->workspace = App::make('CurrentWorkspace');
	}


	public function getName()
	{
		return 'login_'.$this->workspace->domain_prefix.'_'.md5(get_class($this));
	}

	public function getRecallerName()
	{
		return $this->workspace->domain_prefix.'_'.md5(get_class($this));
	}
}
