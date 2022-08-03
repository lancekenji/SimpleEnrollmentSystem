<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: admin_login.html"); 
    exit();
}
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
    $idno =  $request->idno;
	$conn = new mysqli("localhost", "root", "", "enrollment") or die(mysqli_error());
    $sql = "SELECT * FROM student WHERE idno='$idno';";
    $query = $conn->query($sql);
	if($query){
        //Get Subject Details
        $data = [];
        while ($get_details = $query->fetch_assoc()) {
            $data['idno'] = $get_details['idno'];
            $data['fullname'] = $get_details['firstname']." ".$get_details['lastname'];
            $data['course'] = $get_details['course'];
            $data['level'] = $get_details['level']; 
        }
		http_response_code(201);
		echo(json_encode($data));
	}
	else{
		http_response_code(422);
		die(mysqli_error());
	}
    $conn->close();
?>