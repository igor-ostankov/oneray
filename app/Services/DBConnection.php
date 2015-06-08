<?php namespace App\Services;

use App;
use DB;
use Closure;
use Config;
use App\Workspace;

class DBConnection {

	protected $workspace;
	protected $connectionName;
	protected $defaultConnection;

	public function __construct() {
		$this->workspace = App::make('CurrentWorkspace');
		$this->connectionName = 'ws_'.$this->workspace->domain_prefix;
		$this->defaultConnection = DB::getDefaultConnection();
		$this->setConnection();
	}

	protected function setConnection() {
		$config = App::make('config');

		// Will contain the array of connections that appear in our database config file.
		$connections = $config->get('database.connections');

		// This line pulls out the default connection by key
		$defaultConnection = $connections[$config->get('database.default')];

		// Now we simply copy the default connection information to our new connection.
		$newConnection = $defaultConnection;
		// Override the database name.
		$newConnection['database'] = $this->connectionName;

		// This will add our new connection to the run-time configuration for the duration of the request.
		Config::set('database.connections.'.$this->connectionName, $newConnection);
	}

	public function getName() {
		return $this->connectionName;
	}

	public function execute(Closure $callback) {
		DB::setDefaultConnection($this->connectionName);
		call_user_func($callback, $this);
		DB::setDefaultConnection($this->defaultConnection);
	}
}
