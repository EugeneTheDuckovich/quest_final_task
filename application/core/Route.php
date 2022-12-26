<?php

spl_autoload_register(function ($class_name) {
	try{		
		include 'application/controllers/'.$class_name . '.php';
	}
	catch(ErrorException){

	}
});

spl_autoload_register(function ($class_name) {
	try{		
		include 'application/models/'.$class_name . '.php';
	}
	catch(ErrorExceprion){

	}
});

spl_autoload_register(function ($class_name) {
	try{		
		include 'application/core/'.$class_name . '.php';
	}
	catch(ErrorExceprion){

	}
});

class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'conference';
		$action_name = 'list';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$controller_name = $controller_name."Controller";
		
		// создаем контроллер
		$controller = new $controller_name;
		
		$action = '';
		if(str_contains($action_name,'?'))
		{
			$action = substr($action_name,0,strpos($action_name,'?'));
		}
		else
		{
			$action= $action_name;
		}		
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			throw new ErrorException('action not found!');
		}
	
	}
	
	static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}

?>