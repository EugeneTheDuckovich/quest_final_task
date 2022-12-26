<?php

class View
{
	static function render($content_view, $data) : string
	{	
		$view_path = 'application/views/' . $content_view;
		
		ob_start();
		extract($data);
		include $view_path;
		
		return (string)ob_get_clean();
	}
}
?>