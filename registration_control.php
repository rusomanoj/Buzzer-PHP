<?php
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

	$thisfile = $_SERVER['PHP_SELF'];//returns the current script being executed. This variable returns the name and path of the current file

	//read all the posted information
    $handle = $_POST['handle'];
	$password1 = $_POST['password'];
	$password2 = $_POST['confPass'];
	$profile = $_POST['profText'];
	
	//Start session
	session_start();
	
	//Include provided functions
	require_once '/n/www/student/projects/dweb-shared/DWEBfunctions.php';
	//Include extra functions
	require_once 'DWEB_Extra_functions.php'; 
	
	//if all the required fields are filled up from the user
	if(($handle!=NULL && $password1!=NULL) && $password2!=NULL)
	{
		$valiadateResult = validateData($handle, $password1, $password2);
		//on success the validateData() function returns 0
		if($valiadateResult == 0)
		{
			//call the function for read - write
			$identifier = connectdb_rw();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure.
			if($identifier)
			{
				//Create query. Select everything form the users table where the handle is equal with the given handle
				$query="SELECT * FROM users WHERE handle='$handle'";
				//execute query
				$result=mysql_query($query);
				//Check whether the query was successful or not
				if($result) 
				{
					if(mysql_num_rows($result)!=0)//if the query returns any record then DO NOT make the registration 
					{
						//Registration failed
						$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
						$_SESSION['SESS_PAGETITLE'] = "Error Message!";
						$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";//te page to redirect when the user will confirm the error message
						$_SESSION['SESS_ONERRORMESSAGE'] = "A user with the same username already exists.";//the error message.
						header("location: Error.php");
						exit();
					}
					else //else create the new account and send the user to the home page
					{
							//call the funtion to create the account.
							createAccount($handle,$password1,$profile);
					}
				}
				else 
				{
					error($errorMessage."$thisfile: Query failed : Select query failed. (8)\n$query\n".mysql_error());
				}
			}
			else
			{ 
				error($errorMessage."$thisfile: Could not connect to database. (9)");
			}
		}
		else
		{
			//If the validation does not return 0
			$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
			$_SESSION['SESS_PAGETITLE'] = "Error Message!";
			$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";//te page to redirect when the user will confirm the error message
			$_SESSION['SESS_ONERRORMESSAGE'] = "Error in filling form.";//the error message.
			header("location: Error.php");
			exit();
		}
	}
	else // else if not all the required fields are filled redirect the user to the error page.
	{
		$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
		$_SESSION['SESS_PAGETITLE'] = "Error Message!";
		$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
		$_SESSION['SESS_ONERRORMESSAGE'] = "You have not entered all the required information.";
		header("location: Error.php");
		exit();
	}

/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

?>