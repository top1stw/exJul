<?php 
	
	include_once 'Engine/json.php';

	$props = get_json('admin/site_props.json');
	define(_X_, $props->{'def_tpl'});
	define(__COPYRIGHT__, $props->{'copyright'});
	define(_SYSDIR_, 'Engine/');
	define(_XPATH_, 'Template/'._X_);

	include_once 'engine/load_tpl.php';
	include_once 'engine/content.php';
	include_once 'engine/mysql.php';



	$head = file_get_contents('Template/'._X_.'/head.x');
	$body = file_get_contents('Template/'._X_.'/body.x');


//Файл заголовка
	
	while($all_hloads = loadx($head)){
		$head = str_replace($all_hloads[0], file_get_contents('Template/'._X_.'/styles/'.$all_hloads[1]), $head);
	}
	$head = str_replace("{XPATH}", _XPATH_, $head);

	while($all_loads = loadx($body)){
		$body = str_replace($all_loads[0], file_get_contents('Template/'._X_.'/'.$all_loads[1]), $body);
	}
	$body = str_replace("{XPATH}", _XPATH_, $body);

		switch ($_GET['page']) {
		case 'index':
			$head = str_replace("{TITLE}", 'XLand', $head);

			$short_n = get_news();
			$body = str_replace("{CONTENT}", $short_n, $body);
			break;

		case 'full_news':
			$head = str_replace("{TITLE}", 'XLand', $head);
			$full_news = get_newsfull($_GET['id'], $_GET['title']);
			$body = str_replace("{CONTENT}", $full_news, $body);
			break;

		case 'bid':
			$head = str_replace("{TITLE}", 'XLand bid', $head);

			$bid = file_get_contents(_XPATH_.'/bid.x');
			while($bid_body = xload($bid)){
				$bid_tpl = xmake_odj($bid_body[3], $bid_body[2]);
				$bid = str_replace($bid_body[0], $bid_tpl, $bid);
			}
			$body = str_replace("{CONTENT}", $bid, $body);
			break;

		default:
			$head = str_replace("{TITLE}", 'XLand', $head);

			$short_n = get_news();
			$body = str_replace("{CONTENT}", $short_n, $body);
			break;
	}

	$body = str_replace("{COPYRIGHT}", __COPYRIGHT__, $body);
	

	


//Собираем главную страницу
	$page = file_get_contents(_SYSDIR_.'/main.x');

	$page = str_replace("{HEAD}", $head, $page);
	$page = str_replace("{BODY}", $body, $page);
	print($page);

?>