var app = angular.module("app",[]);

app.controller("regController", function($scope, $http){
	$scope.student = {}
	$scope.enroll = function(){
		var request = $http({
			method : "POST",
			url : "/enrollment/public/save.php",
			data :  {
				'firstname': $scope.student.firstname,
				'lastname': $scope.student.lastname,
				'course': $scope.student.course,
				'level': $scope.student.level
				},
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
		})
		
		request.then(function(response){
			$scope.student.firstname = "";
			$scope.student.lastname = "";
			$scope.student.course = "";
			$scope.student.level = "";
			alert('Successfully Registered!');
			localStorage.setItem('idno', response.data.idno);
			localStorage.setItem('fullname', response.data.fullname);
			localStorage.setItem('course', response.data.course);
			localStorage.setItem('level', response.data.level);
			window.location = "./overview.html";
		});
	};	
});
app.controller("loginController", function($scope, $http){
	$scope.admin = {}
	$scope.adminLogin = function(){
		var request = $http({
			method : "POST",
			url : "/enrollment/public/login.php",
			data :  {
				'username': $scope.admin.username,
				'password': $scope.admin.password,
				},
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
		})
		
		request.then(function(response){
			$scope.admin.username = "";
			$scope.admin.password = "";
			if(response.status == 201){
			alert('Welcome to the Administration Panel!');
			window.location = "./admin.php";
			} else {
				alert('Login Error!');
			}
		});
	};	
});
app.controller('overviewController', function($scope, $http){
	var request = $http({
	method : "POST",
	url : "/enrollment/public/fetch_data.php",
	data :  {
		'idno': localStorage.getItem('idno'),
		'fullname': localStorage.getItem('fullname'),
		'course': localStorage.getItem('course'),
		'level': localStorage.getItem('level')
		},
	headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
})
	request.then(function(response){
		$scope.student = {};
		$scope.student.fullname = localStorage.getItem('fullname');
		$scope.student.idno = localStorage.getItem('idno');
		$scope.student.course = localStorage.getItem('course');
		$scope.student.level = localStorage.getItem('level');
		$scope.names = response.data.data;
		localStorage.removeItem('fullname');
		localStorage.removeItem('idno');
		localStorage.removeItem('course');
		localStorage.removeItem('level');
	});
});
app.controller('infoController', function($scope, $http){
	var request = $http({
	method : "GET",
	url : "/enrollment/public/fetch_data_students.php",
})
	request.then(function(response){
		$scope.user = response.data.data;
	});
	$scope.overview = function(idno){
		var get_details = $http({
			method : "POST",
			url : "/enrollment/public/fetch_data_subject.php",
			data :  {
				'idno': idno
			},
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
		})
			get_details.then(function(response){
			localStorage.setItem('idno', response.data.idno);
			localStorage.setItem('fullname', response.data.fullname);
			localStorage.setItem('course', response.data.course);
			localStorage.setItem('level', response.data.level);
			window.location = "./overview.html";
		});
	}
});