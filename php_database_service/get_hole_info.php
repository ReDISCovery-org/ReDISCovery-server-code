<?php

$response = array();

require_once __DIR__ . '/db_connection.php';

$db = new DB_CONNECTION();

if (isset($_GET["hole_number"]) and isset($_GET["course_id"])) {
	$hole_number = $_GET['hole_number'];
	$course_id = $_GET['course_id'];
	$result = mysql_query("SELECT par, tee_lat, tee_long, hole_lat, hole_long FROM hole_info WHERE hole_number = $hole_number and course_id = $course_id");

	if (!empty($result)) {
		if (mysql_num_rows($result) > 0) {
			$response["hole_info"] = array();
			$row = mysql_fetch_array($result);
			$hole_info = array();
			$hole_info["par"] = $row["par"];
			$hole_info["tee_lat"] = $row["tee_lat"];
			$hole_info["tee_long"] = $row["tee_long"];
			$hole_info["hole_lat"] = $row["hole_lat"];
			$hole_info["hole_long"] = $row["hole_long"];
			array_push($response["hole_info"], $hole_info);
			$response["success"] = 1;
			echo json_encode($response);
		}
		else {
			$response["success"] = 0;
			$response["message"] = "No hole information found";
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
