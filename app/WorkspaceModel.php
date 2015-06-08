<?php namespace App;

use App;
use DBConnection;
use Illuminate\Database\Eloquent\Model;

class WorkspaceModel extends Model {

	public function __construct(array $attributes = []) {
		parent::__construct($attributes);

		$this->setConnection(DBConnection::getName());
	}
}