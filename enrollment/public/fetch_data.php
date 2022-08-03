<?php
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
    $idno =  $request->idno;
    $course =  $request->course;
    $level =  $request->level;
    $fullname =  $request->fullname;
	$conn = new mysqli("localhost", "root", "", "enrollment") or die(mysqli_error());
    $sql = "SELECT edp_code FROM subject_offered_details WHERE idno='$idno';";
    $edp = $conn->query($sql);
    $array5 = [
        'idno' => $idno,
        'fullname' => $fullname,
        'course' => $course,
        'level' => $level
    ];
	if($edp){
        $edp_code = $edp->fetch_array(MYSQLI_NUM);
		
        $sql1 = "SELECT * FROM subject_offered WHERE edp_code='".$edp_code[0]."'";
        $get = $conn->query($sql1);

        $data = [];

        //Get Schedule and Room Details
        $i = 0;
        while ($get_details = $get->fetch_assoc()) {
            $data[$i]['time'] = $get_details['start_time']." - ".$get_details['end_time'];
            $data[$i]['days'] = $get_details['days'];
            $data[$i]['room'] = $get_details['room'];

            $data[$i]['subj_code'] = $get_details['subj_code'];

            $sql2 = "SELECT * FROM `subject` WHERE subj_code= '".$data[$i]['subj_code']."'";
            $subj = $conn->query($sql2);
            $get_subj = $subj->fetch_assoc();
    
            //Get Subject Details
            $data[$i]['subj_name'] = $get_subj['subj_name'];
            $data[$i]['subj_type'] = $get_subj['subj_type'];
            $data[$i]['subj_unit'] = $get_subj['subj_unit'];

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