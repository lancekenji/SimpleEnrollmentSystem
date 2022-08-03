<?php
session_start();
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;
$password = $request->password;
$conn = new mysqli("localhost", "root", "", "enrollment") or die(mysqli_error());
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);
$sql = "SELECT * FROM `admin` WHERE `username`='$username' and `password`='$password';";
$query = $conn->query($sql);
$row = $query->fetch_array();
if($query->num_rows != 0){
    $result = [
        'username' => $row['username']
    ];
    $_SESSION['username'] = "user_".uniqid($row['username']);
    http_response_code(201);
    echo(json_encode($result));
}
else{
    http_response_code(422);
    die(mysqli_error());
}
$conn->close();
?>