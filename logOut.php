<?php
/*************************************************************
 *	
 *************************************************************/

	$thisfile = $_SERVER['PHP_SELF'];
	//Start session
	session_start();
	$UserID = $_SESSION['SESS_USERID'];
	
	//Include provided functions
	require_once '/n/www/student/projects/dweb-shared/DWEBfunctions.php';
	//Include extra functions
	require_once 'DWEB_Extra_functions.php';

	//call the function for read-write
	$identifier = connectdb_rw();
	
	if($identifier)
	{
		$thislogin = get_thisLogin($UserID);
		//create query. Insert into the table users the handle and the password
		$query="UPDATE users set lastLogin = '$thislogin' where userID ='$UserID'";
		connectdb_rw();
		//execute query
		$result=mysql_query($query);
		//Check whether the query was successful or not
		if($result) 
		{
			header("location: index.php");
			//Unset the variables stored in session
			unset($_SESSION['SESS_USERID']);
			unset($_SESSION['SESS_CATCHUP']);//on logout unset the session which keeps the buzzes - catchup
			unset($_SESSION);
			session_destroy();
			exit();
		}
		else 
		{
			//header("location: test.php");
			//exit();
			error($errorMessage."$thisfile: Insert query failed (1)\n$query\n".mysql_error());
		}
	}
	else 
	error($errorMessage."$thisfile: Could not connect to database. (16)");

/*************************************************************
 *	
 *************************************************************/

?>