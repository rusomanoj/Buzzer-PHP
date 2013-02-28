<?php	
/*************************************************************
 *	
 *************************************************************/

$thisfile = $_SERVER['PHP_SELF'];
function set_thisLogin($thislogin, $theUserID)
{
	//call the function for read - write
	$identifier = connectdb_rw();
	if($identifier)
	{
		$query="UPDATE users SET thisLogin = '$thislogin' where userID =\"$theUserID\"";
		//Check whether the query was successful or not
		if(!mysql_query($query)) 
		{
			//header("location: test.php");
			error($errorMessage."$thisfile: thisLogin update failed (1)\n$query\n".mysql_error());
			//exit();
		}
	}
	else 
		error($errorMessage."$thisfile: Could not connect to database. (2)");
}
	
function get_UserID($thehandle, $theencrypt)
{
	//call the function for read only
	$identifier = connectdb_read();
	
	if($identifier)
	{
		mysql_real_escape_string($thehandle); //this is used to prevent sql injection. This function escapes some special characters.
		mysql_real_escape_string($theencrypt); //this is used to prevent sql injection. This function escapes some special characters.
		$query2="SELECT userID FROM users WHERE handle='$thehandle' AND password='$theencrypt'";//
		//Check whether the query was successful or not
		//The mysql_query() function executes a query on a MySQL database. This function returns the query handle for SELECT queries, TRUE/FALSE for other queries, or FALSE on failure. 
		if($result2 = mysql_query($query2)) 
		{
		    //The mysql_num_rows() function returns the number of rows in a recordset. This function returns FALSE on failure.
			if(mysql_num_rows($result2)==1)
			{
				//The mysql_fetch_array() function returns a row from a recordset as an associative array and/or a numeric array. This function                  gets a row from the mysql_query() function and returns an array on success, or FALSE on failure or when there are no more rows.
				$f_result2 = mysql_fetch_array($result2);
				return $f_result2[userID];
			}
			else
			{
				return -1;
			}
		}	
		else
		{
			error("$thisfile: select userID failed (6)\n$query2\n".mysql_error());
			return NULL;
		}
	}
	else 
	{
		error("$thisfile: Could not connect to database. (7)");
		return NULL;
	}
}

function get_thisLogin($theUserID)
{
	$query3="SELECT thisLogin FROM users WHERE userID='$theUserID'";//
		//Check whether the query was successful or not
		if($result3 = mysql_query($query3)) 
		{
			if(mysql_num_rows($result3))
			{
				$f_result3 = mysql_fetch_array($result3);
				return $f_result3[thisLogin];
			}
			else
			{
				error("$thisfile: Error with mysql_num_rows. Returned false. (10)\n$query3\n".mysql_error());
				return NULL;
			}
		}	
		else
		{
			error("$thisfile: select thisLogin failed (11)\n$query3\n".mysql_error());
			return NULL;
		}
}

//This function inserts a buzz in the database
function post_Buzz($theUserID, $buzzTimestamp, $theBuzz)
{
	mysql_real_escape_string($theBuzz); //this is used to prevent sql injection. This function escapes some special characters.
	$query4="INSERT buzzes set userID = '$theUserID', timestamp='$buzzTimestamp', buzz = '$theBuzz'";
					//Execute and check whether the query was successful or not
					if(!mysql_query($query4)) 
					{
						error("Insert query failed (17)\n$query4\n".mysql_error());		
					}

}

//This function returns the buzzes and the time in which the buzz were posted
function myBuzzes($theUserID)
{
	//call the function for read
	$identifier = connectdb_read();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure.
	
	if($identifier)
	{
	$query5="SELECT DISTINCT timestamp,buzz FROM buzzes WHERE userID='$theUserID' ORDER BY buzzID DESC";//
		//Check whether the query was successful or not
		if($result5 = mysql_query($query5)) 
		{
				return $result5;
				mysql_close($identifier);
		}	
		else
		{
			error($errorMessage."$thisfile: select userID failed (11)\n$query5\n".mysql_error());
		}		
	}
	else 
	error($errorMessage."$thisfile: Could not connect to database. (20)");
}

//This function returns the timestamp of the buzzes
function theBuzzTimestamp($theUserID, $thebuzz)
{
	//call the function for read
	$identifier = connectdb_read();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
	if($identifier)
	{
	$query6="SELECT timestamp FROM buzzes WHERE userID='$theUserID' AND buzz = '$thebuzz' ORDER BY buzzID DESC";//
		//Check whether the query was successful or not
		if($result6 = mysql_query($query6)) 
		{
			if(mysql_num_rows($result6))
			{
				$f_result6 = mysql_fetch_array($result6);
				return $f_result6[timestamp];
				mysql_close($identifier);
			}
		}	
		else
		{
			error("$thisfile: select userID failed (11)\n$query6\n".mysql_error());
			//error("$thisfile: select userID failed (11)\n$query6\n".mysql_error());
		}
		
	}
	else 
	error("$thisfile: Could not connect to database. (22)");
}

//This function returns all the userIDs of the registered users.
function allUserIDs()
{
	//call the function for read - write
	$identifier = connectdb_read();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
	if($identifier)
	{
	$query7="SELECT userID FROM users";//
		//Check whether the query was successful or not
		if($result7 = mysql_query($query7)) 
		{
			if(!mysql_num_rows($result7)==0)
			{
				while($f_result7 = mysql_fetch_array($result7))
				{
					$array[] = $f_result7[userID];//construct an array with all the registered users.
				}
				return $array;
				mysql_close($identifier);
			}
			else
				return null;//no users
		}	
		else
		{
			error("$thisfile: select userID failed (24)\n$query7\n".mysql_error());
			//error("$thisfile: select userID failed (11)\n$query6\n".mysql_error());
		}
	}
	else 
	error("$thisfile: Could not connect to database. (25)");
}

//fuction that returns an array of all my followings(the people I follow)
function myFollowings($theUserID)
{
	//call the function for read - write
	$identifier = connectdb_read();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
	if($identifier)
	{
	$query8="SELECT followed FROM followers WHERE follower='$theUserID'";//
		//Check whether the query was successful or not
		if($result8 = mysql_query($query8)) 
		{
			if(!mysql_num_rows($result8)==0)
			{
				while($f_result8 = mysql_fetch_array($result8))
				{
					$array[] = $f_result8[followed];//construct an array with all the users that I follow.
				}
				return $array;
				mysql_close($identifier);
			}
			else
				return null;//no followings
		}	
		else
		{
			error("$thisfile: select userID failed (24)\n$query7\n".mysql_error());
		}
	}
	else 
	error("$thisfile: Could not connect to database. (25)");
}

//function that returns an array of all my followers(the people who follow me).
function myFollowers($theUserID)
{
	//call the function for read
	$identifier = connectdb_read();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
	if($identifier)
	{
	$query9="SELECT follower FROM followers WHERE followed='$theUserID' AND follower != 0";//Return all my followers except admin.
		//Check whether the query was successful or not
		if($result9 = mysql_query($query9)) 
		{
			if(!mysql_num_rows($result9)==0)
			{
				while($f_result9 = mysql_fetch_array($result9))
				{
					$array[] = $f_result9[follower];//construct an array with all the users that are following me.
				}
				return $array;
				mysql_close($identifier);
			}
			else
				return null;//no followers
		}	
		else
		{
			error("$thisfile: select userID failed (24)\n$query7\n".mysql_error());
		}
	}
	else 
	error("$thisfile: Could not connect to database. (25)");
}

//This function returns all the userIDs of the users that match with the search handle.
function searchPeople($theSearchHandle)
{
	//call the function for read - write
	$identifier = connectdb_read();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
	if($identifier)
	{
		mysql_real_escape_string($theSearchHandle); //this is used to prevent sql injection. This function escapes some special characters.
		$query10="SELECT userID FROM users WHERE handle LIKE '%$theSearchHandle%' AND handle NOT LIKE 'Admin' ORDER BY handle";//
		//Check whether the query was successful or not
		if($result10 = mysql_query($query10)) 
		{
			if(!mysql_num_rows($result10)==0)
			{
				while($f_result10 = mysql_fetch_array($result10))
				{
					$array[] = $f_result10[userID];//construct an array with all the matched users.
				}
				return $array;
				mysql_close($identifier);
			}
			else
				return "";//no users
		}	
		else
		{
			error("select userID failed (26)\n$query7\n".mysql_error());
			//error("$thisfile: select userID failed (11)\n$query6\n".mysql_error());
		}
	}
	else 
	error("Could not connect to database. (27)");
}

//this function makes a user to unfollow another user.
function unfollow($theUserID, $thepreyID)
{
	if($theUserID != 0)//The Admin is not able to unfollow any of the users. It supposed that it will never happen but just in case...
	{
		//call the function for read - write
		$identifier = connectdb_rw();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
		if($identifier)
		{
			$query11 = "DELETE FROM followers WHERE follower='$theUserID' AND followed='$thepreyID'";
			//Execute and check whether the query was successful or not
			if(!mysql_query($query11)) 
			{
				error("Delete query failed (30)\n$query11\n".mysql_error());
				mysql_close($identifier);						
			}
		}
		else 
			error("Could not connect to database. (29)");
	}
	else if($theUserID == 0)
		return NULL; //The user is the Admin. Admin can't unfollow any of the users.
	else
		return -1;
}

//this function creates an account
function createAccount($handle,$password1,$profile)
{
		mysql_real_escape_string($handle); //this is used to prevent sql injection. This function escapes some special characters.
		mysql_real_escape_string($password1); //this is used to prevent sql injection. This function escapes some special characters.
		mysql_real_escape_string($profile); //this is used to prevent sql injection. This function escapes some special characters.
		//Rule 24: Never store clear-text passwords
		$encrypt=md5($password1);//encrypted password.
		//create query. Insert into the table users the handle, the password and the profile
		$query1="INSERT into users set handle = '$handle', password='$encrypt', profile = '$profile'";
		//Execute and check whether the query was successful or not
		if(mysql_query($query1)) 
		{
			//Login Successful
			header("location: home.php");
			$UserID = get_UserID($handle, $encrypt);//return the new user id 
			//if the logged in user is not the admin
			//if($UserID != 0) 
			//{
				$ResultOfFollow = follow("0", $UserID); //make the Admin to follow the new user.
				if($ResultOfFollow == -1)
					error("$thisfile: the follow function returned -1(error)!");//if follow() returns an error (-1) send a message to the admin.
			//}
			$_SESSION['SESS_USERID'] = $UserID;//keep the userID in a session.
			$timestamp = date('Y-m-d H:i:s');//get the current time. The time that the user loged in.
			set_thisLogin($timestamp, $UserID);//call the function set_thisLogin which sets the field thisLogin to the current time(login time).
			exit();	
		}
		else 
		{
			error($errorMessage."$thisfile: Insert query failed. The new user is not registered (7)\n$query\n".mysql_error());
		}
}

function validateData($handle, $password1, $password2)
{
	//check number of characters of the handle
	if(strlen($handle) < 4 || strlen($handle) > 20)
	{
		$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
		$_SESSION['SESS_PAGETITLE'] = "Error Message!";
		$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
		$_SESSION['SESS_ONERRORMESSAGE'] = "Invalid nickname. Your nickname has to be 4 to 20 characters long.";
		header("location: Error.php");
		exit();	
	}
	else
	{
		//special characters are not permitted. The handle should be 3 to 20 characters long.
		if(preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $handle))
		{
			 //invalid characters in handle.
			$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
			$_SESSION['SESS_PAGETITLE'] = "Error Message!";
			$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
			$_SESSION['SESS_ONERRORMESSAGE'] = "Invalid characters in your nickname. You can use any combination of letters, numbers, underscore or dot.";
			header("location: Error.php");
			exit();	
		}
		else 
		{
			//check if the password1 is equal with the password2
			if($password1 == $password2)
			{
				//check the number of characters of the username
				if(strlen($password1) < 6 || strlen($password1) > 20)
				{
					$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
					$_SESSION['SESS_PAGETITLE'] = "Error Message!";
					$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
					$_SESSION['SESS_ONERRORMESSAGE'] = "Invalid password. Your password has to be 6 to 20 characters long.";
					header("location: Error.php");
					exit();	
				}
				else
				{
					//The password sould be 6 to 20 characters long.
					if(preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $password1))
					{
						//invalid characters in password.
						$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
						$_SESSION['SESS_PAGETITLE'] = "Error Message!";
						$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
						$_SESSION['SESS_ONERRORMESSAGE'] = "Invalid characters in your password.";
						header("location: Error.php");
						exit();	
					}
					else
					{
						return 0; // validation succeed.
					}
				}
			}
			else
			{
				//the password1 is different from the password2.
				$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
				$_SESSION['SESS_PAGETITLE'] = "Error Message!";
				$_SESSION['SESS_ONERRORREDIRECT'] = "index.php";
				$_SESSION['SESS_ONERRORMESSAGE'] = "Different passwords have entered in the form. Give the same password in both fields to confirm.";
				header("location: Error.php");
				exit();	
			}
		}
	}
}

function get_lastLogin($theUserID)
{
	//call the function for read
	$identifier = connectdb_read();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
	if($identifier)
	{
	$query12="SELECT lastLogin FROM users WHERE userID='$theUserID'";//
		//Check whether the query was successful or not
		if($result12 = mysql_query($query12)) 
		{
			if(mysql_num_rows($result12))
			{
				$f_result12 = mysql_fetch_array($result12);
				return $f_result12[lastLogin];
				mysql_close($identifier);
			}
			else
			{
				error("$thisfile: Error with mysql_num_rows. Returned false. (10)\n$query12\n".mysql_error());
				return NULL;
			}
		}	
		else
		{
			error("$thisfile: select lastLogin failed (11)\n$query12\n".mysql_error());
			return NULL;
		}
	}
	else 
		error("Could not connect to database. (29)");
}

function W3CValidator()
{
	print"
	<p>
       <a href=\"http://validator.w3.org/check?uri=referer\"><img
       src=\"http://www.w3.org/Icons/valid-xhtml10\" alt=\"Valid XHTML 1.0 Transitional\" height=\"31\" width=\"88\" /></a>
    </p> ";
}

function validCSS()
{
	print"
	<p>
    <a href=\"http://jigsaw.w3.org/css-validator/check/referer\">
        <img style=\"border:0;width:88px;height:31px\"
        src=\"http://jigsaw.w3.org/css-validator/images/vcss\"
        alt=\"Valid CSS!\" />
    </a>
	</p> ";	
}

/*************************************************************
 *	
 *************************************************************/

?>