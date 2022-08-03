<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: admin_login.html"); 
    exit();
}
	$conn = new mysqli("localhost", "root", "", "enrollment") or die(mysqli_error());
    $sql = "SELECT * FROM student;";
    $query = $conn->query($sql);
	if($query){
        $data = [];

        //Get Student Info
        $i = 0;
        while ($get_details = $query->fetch_assoc()) {
            $data[$i]['idno']= $get_details['idno'];
            $data[$i]['fullname']= $get_details['firstname']." ".$get_details['lastname'];
            $data[$i]['course']= $get_details['course'];
            $data[$i]['level']= $get_details['level'];
            $i++;
        }
		http_response_code(201);
		echo(json_encode(array("data"=>$data)));
	}
	else{
		http_response_code(422);
		die(mysqli_error());
	}
    $conn->close();
?>