<?php

include 'connection.php';

$json_array  = json_decode(file_get_contents('php://input'), true);
$elementCount  = count($json_array);
$keys = array_keys($json_array);
$values = array_values($json_array);

if( intval($values[0]) == 0){
//Insert
	$query = "INSERT INTO ".$keys[0]." VALUES (";
	$t;
	for($t=1;$t<$elementCount-1;$t++){
		$query.="'".$values[$t]."',";
	}
	$query.="'".$values[$t]."')";
	$result = $conn->query($query);


}
	else if ( intval($values[0])==1){
//Update
		$query = "UPDATE ".$keys[0]." SET ";
		$i;
		for($i=2;$i<$elementCount-1;$i++){
			$query .= $keys[$i] . "=";
			if(is_string($values[$i])>=0){
				$query .= "\"".$values[$i]."\",";
			}else{
				$query .= $values[$i].', ';
			}
		}
		$query .= $keys[$i] . "=";
		if(is_string($values[$i])>=0){
			$query .= "\"".$values[$i]."\"";
		}
		else{
				$query .= $values[$i];
			}
		$query .=" WHERE ".$keys[1]." = ".$values[1].";";
		$result = $conn->query($query);
		}else{
//Delete
			$query = "DELETE FROM ".$keys[0]." WHERE ".$keys[1]."=".$values[1];
			$result = $conn->query($query);
		}
	
		var_dump(http_response_code(201));

?> 