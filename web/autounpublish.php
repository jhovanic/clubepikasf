<?php

$con = mysql_connect('localhost','clubepik','epika1978');

if (!$con) {
	
	if (mysql_select_db('clubepik_clubsf',$con)) {
		
		$bonos = array();
		
		$query1 = 'SELECT * FROM Bono WHERE unpublish_date < NOW()';
		
		$resultset = mysql_query($query1, $con);
		
		if (mysql_num_rows($resultset) > 0) {
			
			while ($row = mysql_fetch_assoc($resultset)) {
				$row['is_active'] = 0;
				
				$query2 = 'SELECT * FROM Afiliate_Bono WHERE bono_id='.$row['id'];
				$resultset2 = mysql_query($query2, $con);
				
				if (mysql_num_rows($resultset2) > 0) {
					
					while ($row2 = mysql_fetch_assoc($resultset2)) {
						$row2['is_active'] = 0;
					}
					
				}
				
				
			}
			
		} else {
			echo 'No hay Bonos vencidos';
		}
		
	} else {
		echo 'No se pudo seleccionar la DB';
	}
	
} else {
	echo 'No se pudo conectar';
}

?>