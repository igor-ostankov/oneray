<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App;
use Auth;
use Config;
use App\Services\Guard;
use Illuminate\Auth\EloquentUserProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Auth::extend('workspace', function() {
			$model = Config::get('auth.model');
			$provider = new EloquentUserProvider(App::make('hash'), $model);
			return new Guard($provider, App::make('session.store'));
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
