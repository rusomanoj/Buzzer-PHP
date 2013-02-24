<?php
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

	$thisfile = $_SERVER['PHP_SELF'];
	
	$handle = $_POST['handleLogIn'];
	$password = $_POST['passwordLogIn'];
	//Start session
	session_start();
	
	//Include provided functions
	require_once '/n/www/student/projects/dweb-shared/DWEBfunctions.php';
	//Include extra functions
	require_once 'DWEB_Extra_functions.php';

	//checK the entries for special characters. If there are special characters do not make a query to the database. This is to avoid sql injection.
	if(preg_match('/[\'^&#65533;$%&*()}{@#~?><>,|=+&#65533;-]/', $handle) || preg_match('/[\'^&#65533;$%&*()}{@#~?><>,|=+&#65533;-]/', $password))
	{
		//invalid characters in handle.
		$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
		$_SESSION['SESS_PAGETITLE'] = "Error Message!";
		$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
		$_SESSION['SESS_ONERRORMESSAGE'] = "Wrong Username or Password...";
		header("location: Error.php");
		exit();	
	}
		$encrypt=md5($password);//encrypted password.
		//This function search in the database for the handle and the password and on success returns the userID.
		$UserID = get_UserID($handle, $encrypt);
	
		if($UserID != NULL && $UserID != -1) //if the user exists!
		{
			//Login Successful
			header("location: home.php");//The header() function sends a raw HTTP header to a client. It is important to notice that header() must be called before any actual output is sent. This line redirects the user to the home page.
			$timestamp = date('Y-m-d H:i:s');//get the current time. The time that the user loged in.
			set_thisLogin($timestamp, $UserID);//call the function set_thisLogin which sets the field thisLogin to the current time(login time).			
			$_SESSION['SESS_USERID'] = $UserID; //save the UserID in a session.
			$catchUpResults = catchup($UserID);//return all buzzes by people followed by $UserID.
			//the catchup() function on error returns empty. 
			if($catchUpResults!="")
			{
				$_SESSION['SESS_CATCHUP'] = $catchUpResults;//save all buzzes by people followed by $UserID in a SESSION.
			}
			else 
			{
				//if the catchup function returns empty send a message to the admin.
				error("$thisfile: the catchup function returned empty(error)!");
			}
			exit();
		}
		else if($UserID == -1){
			//Login failed
			$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
			$_SESSION['SESS_PAGETITLE'] = "Error Message!";
			$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
			$_SESSION['SESS_ONERRORMESSAGE'] = "Wrong Username or Password.";
			header("location: Error.php");
			exit();//Wrong to forget this - The reason this is a mistake is that the PHP code of the page continues to execute even though the user has gone to a new location.
		}
		else
		{
			error("$thisfile: An error has occur. The user ID was null.");
		}

/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

?>