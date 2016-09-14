<?php

	session_start();

	if(isset($_POST['acept']))
	{
		if(isset($_POST['login']) && $_POST['login'] == 'admin')
			$_SESSION['name'] = 'admin';
		if(isset($_POST['DEFTPL_PTH']) && !empty($_POST['DEFTPL_PTH']))
		{
			$jsonf = json_decode(file_get_contents("site_props.json"));
			$jsonf->{'def_tpl'} = htmlspecialchars(trim($_POST['DEFTPL_PTH']));
			$x = json_encode($jsonf);
			file_put_contents("site_props.json", $x);
		}
	}
	$page = file_get_contents('template/main.x');
	if($_SESSION['name'] != 'admin')
	{
		print "hello guest!";
		$auth = file_get_contents('template/auth.x');
		$page = str_replace('{TITLE}', "Панель авторизации", $page);
		$page = str_replace('{BODY}', $auth, $page);
	}
	else
	{
		print "hello ". $_SESSION['name'];
		$control = file_get_contents('template/control.x');
		$page = str_replace("{BODY}", $control, $page);

		if(!file_exists("../template/"))exit('Dir template !exist');
		$x = glob('../template/*', GLOB_ONLYDIR);
		foreach ($x as $value) {
			preg_match("/template\/(.*)/", $value, $output_array);
			$xl .= '<option>'.$output_array[1].'</option>';
		}
		$page = str_replace("{DEFTPL}", $xl, $page);
		$page = str_replace('{TITLE}', "Админ панель", $page);
	}

	print($page);

?>