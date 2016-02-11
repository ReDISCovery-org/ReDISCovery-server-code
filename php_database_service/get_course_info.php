<?php

$response = array();

require_once __DIR__ . '/db_connection.php';

$db = new DB_CONNECTION();

if (isset($_GET["course_id"])) {
	$course_id = $_GET['course_id'];

	$result = mysql_query("SELECT hole_number, par FROM hole_info WHERE course_id = $course_id");

	if (!empty($result)) {
		if (mysql_num_rows($result) > 0) {
			$response["course_info"] = array();
			while ($row = mysql_fetch_array($result)) {
				$hole_info = array();
				$hole_info["hole_number"] = $row["hole_number"];
				$hole_info["par"] = $row["par"];
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
