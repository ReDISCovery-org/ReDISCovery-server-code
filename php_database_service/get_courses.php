<?php
	/*
	* Script that will get all of the courses to display
	* in a list on the Android app
	*/

	//array for JSON response
	$response = array();

	//include db connection class
	require_once __DIR__ . '/db_connection.php';

	//connect to database
	$db = new DB_CONNECTION();

	//get all courses from courses table
	$result = mysql_query("SELECT * FROM courses") or die(mysql_error());

	//check for empty result
	if (mysql_num_rows($result) > 0) {

		//loop through all results
		$response["courses"] = array();

		while ($row = mysql_fetch_array($result)) {
			//use temporary array
			$course = array();
			$course["course_id"] = $row["course_id"];
			$course["course_name"] = $row["course_name"];

			//push course into final response array
			array_push($response["courses"], $course);
		}

		//success
		$response["success"] = 1;

		//echoing JSON response
		echo json_encode($response);
	} else {
		//no courses are found
		$response["success"] = 0;
		$response["message"] = "No courses found";

		//echo JSON response
		echo json_encode($response);
	}
?>