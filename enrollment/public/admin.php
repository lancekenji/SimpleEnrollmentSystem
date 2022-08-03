<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: admin_login.html"); 
    exit();
}
?>
<!doctype html>
<html>
	<head>
		<meta charset ="utf-8">
		<meta http-equiv= "X-UA-Compatible" content ="IE-Edge,Chrome=1">
		<meta name ="viewport" content ="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="assets/css/w3.css">
		<script src = "assets/js/angular.min.js"></script>
		<script src = "assets/js/angular-route.min.js"></script>
		<title>CLORES</title>
	</head>
	<body>
		<div ng-app ="app">
			<div class="w3-bar w3-indigo">
				<div class ="w3-center w3-bar">
					<h3>Enrollment System</h3>
				</div>
			</div>
			<ng-view></ng-view>
			<div ng-controller = "infoController">
				<div class = "w3-card-4 w3-animate-top" style = "width:40%; margin:auto;margin-top:1%">
					<div class ="w3-container w3-blue">
						<h3>Student Enrollment</h3>
					</div>
					<table class ="w3-table-all">
                        <thead>
                            <tr class ="w3-light-blue">
                                <th>Student Name</th>
                                <th>ID Number</th>
                                <th>Course</th>
                                <th>Level</th>
                                <th>Full Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="u in user">
                                <td>{{ u.fullname }}</td>
                                <td>{{ u.idno }}</td>
                                <td>{{ u.course }}</td>
                                <td>{{ u.level }}</td>
                                <td>
                                <button type="button" ng-click="overview(u.idno)">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
		<script src = "assets/js/ui_app.js"></script>
	</body>
</html>