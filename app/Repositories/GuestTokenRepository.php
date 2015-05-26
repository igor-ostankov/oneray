<?php namespace App\Repositories;

use App\Workspace;
use Carbon\Carbon;
use DB;
use Config;

class GuestTokenRepository {

	/**
	 * The database connection instance.
	 *
	 * @var \Illuminate\Database\ConnectionInterface
	 */
	protected $connection;

	/**
	 * The token database table.
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * The workspace where token applies to.
	 *
	 * @var Workspace
	 */
	protected $workspace;

	/**
	 * The hashing key.
	 *
	 * @var string
	 */
	protected $hashKey;

	/**
	 * The number of seconds a token should last.
	 *
	 * @var int
	 */
	protected $expires;

	/**
	 * Create a new token repository instance.
	 *
	 * @param  \Illuminate\Database\ConnectionInterface  $connection
	 * @param  string  $table
	 * @param  Workspace $workspace
	 * @param  string  $hashKey
	 * @param  int  $expires
	 * @return void
	 */
	public function __construct(Workspace $workspace)
	{
		$this->workspace = $workspace;
		$this->table = 'guest_tokens';
		$this->hashKey = Config::get('key');
		$this->expires = 60 * 60 * 3;
		$this->connection = DB::connection();
	}

	/**
	 * Create a new token record.
	 *
	 * @param  string $email
	 * @return string
	 */
	public function create($email)
	{
		$this->deleteExisting($email);
		$token = $this->createNewToken($email);
		$this->getTable()->insert($this->getPayload($email, $token));

		return $token;
	}

	/**
	 * Delete all existing reset tokens from the database.
	 *
	 * @param  string $email
	 * @return int
	 */
	protected function deleteExisting($email)
	{
		return $this->getTable()->where('email', $email)->where('workspace_id', $this->workspace->id)->delete();
	}

	/**
	 * Build the record payload for the table.
	 *
	 * @param  string  $email
	 * @param  string  $token
	 * @return array
	 */
	protected function getPayload($email, $token)
	{
		return ['email' => $email, 'workspace_id' => $this->workspace->id, 'token' => $token, 'created_at' => new Carbon];
	}

	/**
	 * Determine if a token record exists.
	 *
	 * @param  string  $token
	 * @return bool
	 */
	public function exists($token)
	{
		$token = (array) $this->getTable()->where('workspace_id', $this->workspace->id)->where('token', $token)->first();

		return $token && ! $this->tokenExpired($token);
	}

	/**
	 * Get an email associated with token
	 *
	 * @param  string  $token
	 * @return string
	 */
	public function getEmail($token)
	{
		$record = (array) $this->getTable()->where('token', $token)->first();
		return $record['email'];
	}

	/**
	 * Determine if the token has expired.
	 *
	 * @param  array  $token
	 * @return bool
	 */
	protected function tokenExpired($token)
	{
		$createdPlusHour = strtotime($token['created_at']) + $this->expires;

		return $createdPlusHour < $this->getCurrentTime();
	}

	/**
	 * Get the current UNIX timestamp.
	 *
	 * @return int
	 */
	protected function getCurrentTime()
	{
		return time();
	}

	/**
	 * Delete a token record by token.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function delete($token)
	{
		$this->getTable()->where('token', $token)->delete();
	}

	/**
	 * Delete expired tokens.
	 *
	 * @return void
	 */
	public function deleteExpired()
	{
		$expired = Carbon::now()->subSeconds($this->expires);

		$this->getTable()->where('created_at', '<', $expired)->delete();
	}

	/**
	 * Create a new token for the user.
	 *
	 * @param  string $email
	 * @return string
	 */
	public function createNewToken($email)
	{
		return hash_hmac('sha256', str_random(40), $this->hashKey);
	}

	/**
	 * Begin a new database query against the table.
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	protected function getTable()
	{
		return $this->connection->table($this->table);
	}

	/**
	 * Get the database connection instance.
	 *
	 * @return \Illuminate\Database\ConnectionInterface
	 */
	public function getConnection()
	{
		return $this->connection;
	}

}
