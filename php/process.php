<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$db='formsdata';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
	if(! $conn )
	{
	  die('Could not connect: ' . mysqli_connect_error());
	}
	
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $u_name=$_POST["fname"];
    $u_lname=$_POST["lname"];
    $u_email=$_POST["email"];
    $u_message=$_POST["messagee"];
    if (empty($u_name) || strlen($u_name)==1){
		die("Please enter your name");
	}
    if (empty($u_lname)){
		die("Please enter your last name");
	}
	if (empty($u_email) || !filter_var($u_email, FILTER_VALIDATE_EMAIL)){
		die("Please enter valid email address");
		
	}
		
	if (empty($u_message)){
		die("Please enter message");
	}	


    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
    if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
    $statement = $mysqli->prepare("INSERT INTO Users_data (fname, lname, email, messagee) VALUES(?, ?, ?, ?)");
    $statement->bind_param('ssss', $u_name, $u_lname, $u_email, $u_message); //bind values and execute insert query
	
    if($statement->execute()){
		$email=trim($u_email);
		$username= explode("@", $email);
		$init=substr($u_name, 0,1);
		$initi=substr($u_lname, 0,1);
		$arr=array('Hello',$init, $initi, 'with username ' , $username[0],'!','your','message','has','been','saved. ');
		echo implode(" ", $arr);
		echo str_replace('xxxx', $u_email, 'We will contact you on your email xxxx as soon as possible');
	
	}else{
		print $mysqli->error; //show mysql error if any
	}
}