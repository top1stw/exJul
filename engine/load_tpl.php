<?php 

	function loadx ($file_name)
	{
		preg_match("/<!--load:(.*);-->/", $file_name, $output_array);
		return $output_array;

	}

	function xload ($file_name)
	{
		preg_match("/<!--xload:(.*)-(.*)-(.*);-->/", $file_name, $output_array);
		return $output_array;
	}

	function xmake_odj ($block_name, $block_kind)
	{
		$block_name = htmlspecialchars(trim($block_name));
		$block_kind = htmlspecialchars(trim($block_kind));
		if($block_kind == 'text'){
			$block = '<input type="text"';// name="'.$block_name.'"/>';
		}
		elseif ($block_kind == 'pswd'){
			$block = '<input type="password"';// name="'.$block_name.'"/>';
		}
		elseif ($block_kind == 'submit'){
			$block = '<input type="submit"';// name="'.$block_name.'"/>';
		}
		$block .= 'name="'.$block_name.'"/>';
		return $block;
	}

	function _array_replace($array, $page)
	{
		return str_replace(array_keys($array), array_values($array), $page);
	}

	function to_array($var)
	{
		$res_var = array ();
		$count = 0;
		while($row = mysqli_fetch_array($var, MYSQLI_ASSOC))
		{
			$res_var[$count] = $row;
			$count++;
		}
		return $res_var;
	}

?>