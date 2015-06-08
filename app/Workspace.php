<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;
use DBConnection;
use Artisan;
use PhpSpec\Exception\Exception;

class Workspace extends Model {

	protected $fillable = ['name', 'domain'];

	public static function boot()
	{
		parent::boot();

		// Creating DB on model creation
		Workspace::created(function($workspace) {
			if(DB::statement("CREATE DATABASE ws_$workspace->domain_prefix")) {
				App::instance('CurrentWorkspace', $workspace);

				DBConnection::execute(function() {
					Artisan::call('migrate:install');
					Artisan::call('migrate', array('--path' => 'database/migrations/workspace'));
				});
			}
		});

		Workspace::deleted(function($workspace) {
			DB::statement("DROP DATABASE ws_$workspace->domain_prefix");
		});
	}


	/**
	 * Users that consists in the Workspace
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users() {
		return $this->belongsToMany('App\User');
	}

}
