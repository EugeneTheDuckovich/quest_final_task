<?php

class Model
{
	protected $db;

	public function __construct()
	{
		$db = new PDO('mysql:host=localhost;dbname=conference_db', 'root', '');
	}
	public function get_data()
	{
	}
}

?>