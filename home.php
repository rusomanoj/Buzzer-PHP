<?php
/*************************************************************
 *	
 *************************************************************/

$thisfile = $_SERVER['PHP_SELF'];
//start session
session_start();

//clear the session. This session contains the previous searched value.
unset($_SESSION['searchval']);

//if the $_SESSION['SESS_HANDLE'] is empty(no user logged in) trap the user in index page.
if(!(isset($_SESSION['SESS_USERID']))) 
{
    header("location: index.php");
	exit();
}

$UserID = $_SESSION['SESS_USERID']; 

//Include provided functions
	require_once '/n/www/student/projects/dweb-shared/DWEBfunctions.php';
	
//Include extra functions
require_once 'DWEB_Extra_functions.php';	

$message = "";
//if the button for the submission of the buzz has been pressed
if(isset($_POST['Submit1']))
{
	$message="Your Buzz was not sent";//
	$buzztext = $_POST['buzzText'];
	if($_SESSION['lastBuzz'] != $_POST['buzzText'])//just so they can't refresh and buzz again
	{
	if(strlen($buzztext)<142)
	{
	//call the function for read - write
	$identifier = connectdb_rw();//connect to the database for read-write access. Returns a MySQL link identifier on success ot FALSE on failure. 
	
	  if($identifier)
	  {
		  if(!($buzztext== "Enter your Buzz..."))//if the text is not the default text
		  {
			  if(!(str_replace (" ", "", $buzztext) == ""))//if it is not empty
			  {
				  $buzzTimestamp = date('Y-m-d H:i:s');//get the current time.
				  post_Buzz($UserID, $buzzTimestamp, $buzztext); 
				  mysql_close($identifier);
				  $message = "Your Buzz has successfully been sent"; 
				  $_SESSION['lastBuzz'] = $buzztext;
			  }
		  }		
	  }
	  else 
		  error("$thisfile: Could not connect to database. (18)");
	}
	else 
	{
		$_SESSION['SESS_ADVMESSAGE'] = " Please try again.";
		$_SESSION['SESS_PAGETITLE'] = "Error Message!";
		$_SESSION['SESS_ONERRORREDIRECT'] = "home.php";
		$_SESSION['SESS_ONERRORMESSAGE'] = "The length of your buzz should be less than 141 characters..";
		header("location: Error.php");
		exit();
	}
	}
	else
	{
		$message = "";	
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buzzer</title>
<script type="text/javascript" src='javascript_code.js'></script>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>

<body onload="createLabelMaxChar()">
	<div class="container"> 
		<div class="header">
				<div align="center"><img src="images/Buzzer_logo.jpg" alt="Buzzer_logo"/> </div>
				<div class="top_box_navigation">
					<div class="menu">
						<ul>
							<li>
								<span>Home</span> <!-- <a class="check" href="home.php">Home</a> -->				
							</li>
							<li>
								<a href="profile.php?sel=3">Profile</a>					
							</li>
							<li class="last">
								<a href="design.php">Design</a>					
							</li>
			    		</ul>
                        <ul class="rightMenu">
                            <li>
                            	<a href="account.php">Account</a>
                            </li>
                            <li class="last" >
                    			<a href="logOut.php">Log Out</a>
                            </li>
                        </ul> 
			  		</div> <!-- end menu -->
                 </div> <!-- end top_box_navigation -->
                 
                 <div class="bottom_box_header">
					  Home   
				 </div> <!-- end bottom_box_header -->
		</div> <!-- end header -->
		
		<div class="wrap">

<!-- LEFT_SIDE -->
<?php 
	//Include the left side of the page. (Links for followers, following, buzzes, Search engine).
	require_once 'left_side.php'; 
?>
<!-- END LEFT_SIDE -->
			<div class="right">
				<div class="top_box">
					<h2>Buzz...</h2>
				</div> <!-- end top_box -->
				<div class="middle_box_big">
                <form id="postMyBuzz" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                	<textarea name="buzzText" id="buzzText" onkeydown="maxCharactershome(this,141)" onkeyup="maxCharactershome(this,141)" onfocus="clearContainingTexthome(this)" onblur="addDefaultTextOnEmptyhome(this)" rows="3" cols="80" style="margin-top:10px; height:60px; resize:none;"></textarea>
                    <div align="right">
                    <div id="remainingCharacters"></div>
                    <input type="submit" value="Post" id="Submit1" name="Submit1" style="margin-top:10px"/>
                    </div>
                </form>
                <div id="postMyBuzzInfo"><?php print"$message"?></div>
				</div> <!-- end middle_box_big -->
				<div class="bottom_box"> 
														
				</div> <!-- end bottom_box -->
                
                
				<div class="top_box">
					<h2>Buzzes</h2>
				</div> <!-- end top_box -->
				<div class="middle_box_big">
                	<?php
						//this session contains all the new buzzes of the users who the logged in user is following.
						$arraysOfBuzzes = $_SESSION['SESS_CATCHUP'];
						if (is_array($arraysOfBuzzes) && $arraysOfBuzzes!=NULL)//we check if it is an array.
						{
							foreach($arraysOfBuzzes as $key => $row) 
							{
								$timeOfBuzz = theBuzzTimestamp($row['userID'], $row['buzz']);
								print" 
								<div style=\"border-bottom:double; width:100%; border-color:#FFFFFF;\">
								<div class=\"top_box\">
									<h2>$row[handle]| <font size=\"1\" color=\"#EAA61A\"> $timeOfBuzz </font></h2> 
								</div> <!-- end top_box -->
								<div class=\"middle_box_medium\">
									$row[buzz]
								</div> <!-- end middle_box_medium -->
								<div class=\"bottom_box\">
								</div> <!-- end bottom_box-->
								</div>";
							}	
						}
						else
						{
							print"<h2>No new buzzes are available.</h2>";
						}
					?>
                    
   				</div> <!-- end middle_box_big -->
				<div class="bottom_box"> 
														
				</div> <!-- end bottom_box -->					
			</div> <!-- end right -->
		<!-- /////// -->			
        
		</div><!-- end wrap -->
	</div> <!-- end container -->

<!-- 
 *************************************************************
 *	
 ************************************************************* 
 -->

</body>
</html>