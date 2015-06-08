<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DBConnectionServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('dbconnection', 'App\Services\DBConnection');
	}

}
