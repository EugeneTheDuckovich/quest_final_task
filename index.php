 <?php 

 spl_autoload_register(function ($class_name) {
	try{		
		include 'application/core/'.$class_name . '.php';
	}
	catch(ErrorException){

	}
});

 ini_set('error_reporting', E_ERROR);
 Route::start();
 ?>