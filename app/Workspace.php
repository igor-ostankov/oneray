<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model {

	protected $fillable = ['name', 'domain'];

	/**
	 * Users that consists in the Workspace
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users() {
		return $this->belongsToMany('App\User');
	}

}
