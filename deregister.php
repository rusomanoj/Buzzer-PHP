<?php
/*************************************************************
 *	
 *************************************************************/

	//Start session
	session_start();
	$UserID = $_SESSION['SESS_USERID'];
	
	if(!(isset($_SESSION['SESS_USERID']))) 
	{
    	header("location: index.php");
		exit();
	}
	
	//Include provided functions
	require_once '/n/www/student/projects/dweb-shared/DWEBfunctions.php';
	
	if(!$UserID == 0) 
	{
		//call the function deregister to deregister the user from the system.
		$deregisterResult = deregister($UserID);
		if($deregisterResult == 0) //0 on success
		{
			$_SESSION['SESS_ADVMESSAGE'] = "new account.";
			$_SESSION['SESS_PAGETITLE'] = "Successful Deregistration!";
			$_SESSION['SESS_ONERRORREDIRECT'] = "home.php";
			$_SESSION['SESS_ONERRORMESSAGE'] = "Your account has been deleted successfully. Thank you for using Buzzer. You can create a";
			header("location: Error.php");
			//Unset the variables stored in session
			unset($_SESSION['SESS_USERID']);
			exit();
		}
		else if($deregisterResult == -1) //-1 if $userID is null (should never happen). If it is null the user logs out automatically.
		{
			$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
			$_SESSION['SESS_PAGETITLE'] = "Error Message!";
			$_SESSION['SESS_ONERRORREDIRECT'] = "home.php";
			$_SESSION['SESS_ONERRORMESSAGE'] = "Error. Unknown user. Unable to deregister.";
			header("location: Error.php");//error page!
			exit();
			//Send error message to Admin. New Buzz! 
			error("The user's ID was null. Unacceptable!");
		}
		else if($deregisterResult == -2) //-2 if $UserID==0 (cannot deregister Admin).This is also checked before calling the deregister function. Double check, just to be sure.
		{
			$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
			$_SESSION['SESS_PAGETITLE'] = "Error Message!";
			$_SESSION['SESS_ONERRORREDIRECT'] = "home.php";
			$_SESSION['SESS_ONERRORMESSAGE'] = "Error. Unable to deregister this user.";
			header("location: Error.php");//error page!
			exit();
			//Send error message to Admin. New Buzz! 
			error("The user's ID was 0. User with 0 ID is the Admin. Admin cannot be deregistered.");
		}
		else if($deregisterResult == -3) //on any other error (details in $errorMessage)
		{
			$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
			$_SESSION['SESS_PAGETITLE'] = "Error Message!";
			$_SESSION['SESS_ONERRORREDIRECT'] = "home.php";
			$_SESSION['SESS_ONERRORMESSAGE'] = "Sorry an internal error has occur.";
			header("location: Error.php");//error page!
			exit();
			//Send error message to Admin. New Buzz! 
			error($errorMessage);		
		}
	}
	else//if the user is the admin
	{
		$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
		$_SESSION['SESS_PAGETITLE'] = "Error Message!";
		$_SESSION['SESS_ONERRORREDIRECT'] = "home.php";
		$_SESSION['SESS_ONERRORMESSAGE'] = "Error. Unable to deregister this user 1.";
		header("location: Error.php");//error page!
		exit();
	}

/*************************************************************
 *	
 *************************************************************/

?>