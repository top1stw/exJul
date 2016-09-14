<?php

	function get_json($filename)
	{
		$f = file_get_contents($filename);
		return json_decode($f);
	}


?>