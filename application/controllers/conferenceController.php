<?php

class conferenceController extends Controller
{
	function __construct()
	{		
		$this->model = new ConferenceModel();
		//$this->view = new View();
	}
	
	function list()
	{
		$data = $this->model->get_data();
		echo (string)View::render('conference_list_view.php',$data);
	}

	function delete()
	{
		$id = substr($_GET['id'],0,strlen($_GET['id'])-1);
		$this->model->delete($id);
		header('Location: /conference/list',true,301);
	    exit();
	}

	function create()
	{
		$data = array();
		echo (string)View::render('create_conference.php',$data);
	}

	function add()
	{
		if(!isset($_POST['title']) || !isset($_POST['date'])
		|| !isset($_POST['latitude'])|| !isset($_POST['longtitude'])
		|| !isset($_POST['country']))
		{
			header('Location: /conference/create',true,301);
			exit();
		}
		$title = $_POST['title'];


		$date = strtotime($_POST['date']);
		if(!$date)
		{
			header('Location: /conference/create',true,301);
			exit();
		}
		$validated_date = date('Y-m-d',$date);

		$latitude = (float)$_POST['latitude'];
		$longtitude = (float)$_POST['longtitude'];
		$country = $_POST['country'];

		if($_POST['latitude'] != strval($latitude) || $_POST['longtitude'] != strval($longtitude))
		{
			header('Location: /conference/create',true,301);
			exit();	
		}

		if($latitude > 180.0 || $latitude < -180.0 || $longtitude > 90.0 || $longtitude < -90.0)
		{
			header('Location: /conference/create',true,301);
			exit();			
		}

		//echo "ST_GeomFromText('POINT(".strval($latitude)." ".strval($longtitude).")')";
		
		$this->model->add($title,$validated_date,$latitude,$longtitude,$country);
		
		header('Location: /conference/list',true,301);
	    exit();
	}

	function edit_form()
	{
		$id = $_GET['id'];
		
		$data = ['data' => $this->model->get_details($id)];
		echo (string)View::render('edit_conference.php',$data);
	}

	function edit()
	{
		if( !isset($_POST['id']) || !isset($_POST['title']) 
		|| !isset($_POST['date']) || !isset($_POST['latitude'])
		|| !isset($_POST['longtitude']) || !isset($_POST['country']))
		{
			header('Location: /conference/edit_form?id='.$_POST['id'].'%2F',true,301);
			exit();
		}
		$id = $_POST['id'];
		$title = $_POST['title'];


		$date = strtotime($_POST['date']);
		if(!$date)
		{
			$_GET['id'] = $_POST['id'];
			header('Location: /conference/edit_form?id='.$_POST['id'].'%2F',true,301);
			exit();
		}
		$validated_date = date('Y-m-d',$date);

		$latitude = (float)$_POST['latitude'];
		$longtitude = (float)$_POST['longtitude'];
		$country = $_POST['country'];

		if($_POST['latitude'] != strval($latitude) || $_POST['longtitude'] != strval($longtitude))
		{
			header('Location: /conference/edit_form?id='.$_POST['id'].'%2F',true,301);
			exit();	
		}

		if($latitude > 180.0 || $latitude < -180.0 || $longtitude > 90.0 || $longtitude < -90.0)
		{
			$_GET['id'] = $_POST['id'];
			header('Location: /conference/edit_form?id='.$_POST['id'].'%2F',true,301);
			exit();			
		}

		//echo "ST_GeomFromText('POINT(".strval($latitude)." ".strval($longtitude).")')";
		
		$this->model->edit($id,$title,$validated_date,$latitude,$longtitude,$country);
		
		header('Location: /conference/list',true,301);
	    exit();
	}

	function details()
	{
		$id = $_GET['id'];

		$data = ['data' => $this->model->get_details($id)];
		echo View::render('details_of_conference.php',$data);
	}
}

?>