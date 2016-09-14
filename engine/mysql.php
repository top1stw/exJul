<?php

	function connect()
	{
		$host = 'localhost';
		$user = 'root';
		$pswd = null;
		$db = 'xland';
		$link = mysqli_connect($host, $user, $pswd);
		if($link && mysqli_select_db($link, $db))
			return $link;
		else
			print("Mysqli_connect Error ".mysqli_error ($link));
	}

?>
