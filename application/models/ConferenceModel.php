<?php

class ConferenceModel
{

	public function get_data()
	{	
		$db = new PDO('mysql:host=localhost;dbname=conference_db', 'root', '');
		$result = $db->query('SELECT id, title, date  FROM conference')->fetchAll();
		
		return $result;
	}

	public function get_details($id)
	{
		$db = new PDO('mysql:host=localhost;dbname=conference_db', 'root', '');
		$statement = $db->prepare('SELECT id, title, date,ST_X(address),ST_Y(address),country FROM conference WHERE id=?');
		$statement->execute([$id]);
		$result = $statement->fetch(PDO::FETCH_LAZY);
		return $result;
	}

	public function delete($id)
	{
		$db = new PDO('mysql:host=localhost;dbname=conference_db', 'root', '');
		$statement = $db->prepare('DELETE  FROM conference WHERE id=?');
		$statement->execute([$id]);
	}

    public function add($title,$date,$latitude,$longtitude,$country)
    {
		$db = new PDO('mysql:host=localhost;dbname=conference_db', 'root', '');
		
		$statement = $db->prepare("INSERT INTO conference(title,date,address,country)
								  VALUES(?,?,ST_GeomFromText( CONCAT('POINT(', ?, ' ', ?, ')') ) ,?)");
		
		$statement->execute([$title,$date,$latitude,$longtitude,$country]);
    }

	public function edit($id,$title,$date,$latitude,$longtitude,$country)
	{
		$db = new PDO('mysql:host=localhost;dbname=conference_db', 'root', '');
		
		$statement = $db->prepare(
			"UPDATE conference
			 SET
			 title = ?,
			 date = ?,
			 address = ST_GeomFromText( CONCAT('POINT(', ?, ' ', ?, ')') ),
			 country = ?
			 WHERE id = ?");
		
		$statement->execute([$title,$date,$latitude,$longtitude,$country,$id]);
	}
}

?>