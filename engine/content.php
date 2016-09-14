<?php

	function fnews_query($var, $id, $title)
	{
		$link = connect();
		if($var !='FULL')
			$query = "SELECT id, title, short, category, author  FROM x_news";
		else
			$query = "SELECT title, full, category, author FROM x_news WHERE id='$id' and title='$title'";
		$res = mysqli_query($link, $query);
		return to_array($res);
	}

	function get_news()
	{
		$form = file_get_contents(_XPATH_.'/short_news.x');
		$array = fnews_query(SHORT, null, null);
		foreach ($array as $val)
			$news .= _array_replace(array('{ID}'=>$val['id'], '{TITLE}'=>$val['title'], '{SHORT}'=>$val['short'], '{CATEGORY}'=>$val['category'], '{AUTHOR}'=>$val['author']), $form);
		return  $news;
	}

	function get_newsfull($id, $title)
	{
		$formfull = file_get_contents(_XPATH_.'/full_news.x');
		$arrayfull = fnews_query(FULL, $id, $title);
		foreach ($arrayfull as $val)
			$fullnews = _array_replace(array('{TITLE}' =>$val['title'], '{FULL}' =>$val['full'], '{CATEGORY}'=>$val['category'], '{AUTHOR}'=>$val['author']), $formfull);
		return $fullnews;
	}


?>