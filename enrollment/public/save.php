<?php
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$firstname = $request->firstname;
    $lastname = $request->lastname;
    $course = $request->course;
    $level = $request->level;
    $idno = "2022".$level."00".rand(99, 999);
	$conn = new mysqli("localhost", "root", "", "enrollment") or die(mysqli_error());
	if($conn->query("INSERT INTO `student` (`idno`, `firstname`, `lastname`, `course`, `level`) VALUES('$idno', '$firstname', '$lastname', '$course', '$level')")){
		$edp_code = "213".$level."000";
		$conn->query("INSERT INTO `subject_offered_details` (`idno`, `edp_code`) VALUES('$idno', $edp_code);");
		$result = [
			'idno' => $idno,
			'fullname' => $firstname." ".$lastname,
			'course' => $course,
			'level' => $level
		];
		http_response_code(201);
		echo(json_encode($result));
	}
	else{
		http_response_code(422);
		die(mysqli_error());
	}
	$conn->close();
?>