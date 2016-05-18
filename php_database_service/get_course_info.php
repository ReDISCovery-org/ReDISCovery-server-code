<?php

$response = array();

require_once __DIR__ . '/db_connection.php';

$db = new DB_CONNECTION();

if (isset($_GET["course_name"])) {
	$course_name = $_GET['course_name'];

	$result = mysql_query("SELECT h.hole_number, h.par, h.tee_lat, h.tee_long, h.hole_lat, h.hole_long FROM courses as c inner join hole_info as h on c.course_id=h.course_id WHERE c.course_name = $course_name");

	if (!empty($result)) {
		if (mysql_num_rows($result) > 0) {
			$response["course_info"] = array();
			while ($row = mysql_fetch_array($result)) {
				$hole_info = array();
				$hole_info["hole_number"] = $row["hole_number"];
				$hole_info["par"] = $row["par"];
				$hole_info["tee_lat"] = $row["tee_lat"];
				$hole_info["tee_long"] = $row["tee_long"];
				$hole_info["hole_lat"] = $row["hole_lat"];
				$hole_info["hole_long"] = $row["hole_long"];	
				array_push($response["course_info"], $hole_info);
			}
			$response["success"] = 1;
			echo json_encode($response);
		}
		else {
			$response["success"] = 0;
			$response["message"] = "No course information found";
			echo json_encode($response);
		}
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Required field(s) is missing";
		echo json_encode($response);
	}
}

?>
