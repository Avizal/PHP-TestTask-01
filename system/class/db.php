<?php

class DB {
	private $link;

    public function __construct($hostname, $username, $password, $database, $port = '3306') {
		if (!$this->link = mysqli_connect($hostname, $username, $password, $database, $port)) {
			exit('Error: Could not make a database link using ' . $username . '@' . $hostname);
		}

		if (!mysqli_select_db($this->link, $database)) {
			exit('Error: Could not connect to database ' . $database);
		}
	}

	public function query($sql) {
		if ($this->link) {
			$resource = mysqli_query($this->link, $sql, MYSQLI_USE_RESULT );

			if (!$resource->errno) {
				$data = array();
				while ($row = $resource->fetch_assoc()) {
					$data[] = $row;
				}

				return $data;
			} else {
				return false;
			}
		}
	}
}