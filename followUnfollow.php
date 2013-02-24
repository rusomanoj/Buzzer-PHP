<?php
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

//if the $_SESSION['SESS_HANDLE'] is empty(no user logged in) trap the user in index page.
if(!(isset($_SESSION['SESS_USERID']))) 
{
    header("location: index.php");//redirect here.
	exit();
}

$thisfile = $_SERVER['PHP_SELF'];
if(isset($_POST['submitFollowUnfollow']))//if the button for follow or unfollow a user has been pressed.
{
		$preyID = $_POST['hiddenPreyUid'];
		$buttonValue = $_POST['submitFollowUnfollow'];
		if($buttonValue == "Follow")
		{
			if($UserID != $preyID && $preyID != 0)//everytime you call the follow make sure that the UserID is not equal to the preyID.Each user cannot follow himself/herself. The preyID should not be 0(noone can follow the admin. The admin follows himself/herself).
			{
				$followResult = follow($UserID, $preyID);
				if($followResult==-1)
				{
					//Send error message to Admin. New Buzz! 
					error($errorMessage."%thisfile: The user with id $UserID was unable to follow the user with id $preyID. Follow function return error");
				}
			}
		}	
		else if($buttonValue == "UnFollow")
		{
			$ResultOfUnfollow = unfollow($UserID, $preyID);
			if($ResultOfUnfollow == -1)
			{
				error($errorMessage."%thisfile: Error on unfollow. The unfollow function has returned -1(error)");
			}
		}
}

/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

?>