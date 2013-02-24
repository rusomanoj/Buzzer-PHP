<?php //make sure nothing gets sent to the browser before session_start();
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/
 
//start session
session_start();
//clear the session
unset($_SESSION['searchval']);

//if the $_SESSION['SESS_USERID'] is empty(no user logged in) trap the user in index page.
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
if(isset($_POST['Submit1']))//if the button for the submission of the buzz has been pressed
{
		$profileText = $_POST['profileText'];
		/* If the profileText text is the default or if the profileText is empty(has only spaces or nothing). Send empty profile. 
		 * Else send the containing text.  */
		if($profileText == "Enter your new Profile...")
		{
			//$textToSend = str_replace ("Enter your new Profile...", " ", $profileText);	
			//setProfile($UserID, $textToSend);
			$message = "Your profile has not changed.";
		}
		else if(str_replace (" ", "", $profileText) == "")
		{
			$textToSend = str_replace (" ", "", $profileText) == " ";
			setProfile($UserID, $textToSend);
			$message = "Your profile has been updated.";
		}
		else
		{
			setProfile($UserID, $profileText);
			$message = "Your profile has been updated.";
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

<body>
	<div class="container"> 
		<div class="header">
				<div align="center"><img src="images/Buzzer_logo.jpg" alt="Buzzer_logo"/> </div>
				<div class="top_box_navigation">
					<div class="menu">
						<ul>
							<li>
								<a href="home.php">Home</a>					
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
                            	<span>Account</span><!-- <a class="check" href="account.php">Account</a> -->
                            </li>
                            <li class="last" >
                    			<a href="logOut.php">Log Out</a>
                            </li>
                        </ul> 
			  		</div> <!-- end menu -->
                    
                 </div> <!-- end top_box_navigation -->
                 <div class="bottom_box_header">
					  <label>Account</label>  
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
					<h2>Change Profile</h2>
				</div> <!-- end top -->
				<div class="middle_box_big">
					<label>Click in the box to enter your new Profile:</label>
                    <br/>
                <form id="changeProfile" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                	<textarea name="profileText" id="profileText" onfocus="clearContainingText(this)" onblur="addDefaultTextOnEmpty(this)" rows="1" cols="80" style="margin-top:10px; height:20px; resize:none;">Enter your new Profile...</textarea>
                    <div align="right">
                    <input type="submit" value="Change Profile" id="Submit1" name="Submit1" style="margin-top:10px"/>
                    </div>
                </form>
                <div id="changeProfileInfo"><?php print"$message" ?></div>
				</div> <!-- end middle_big -->
				<div class="bottom_box"> 
														
				</div> <!-- end bottom -->
                
                
                <div class="top_box">
					<h2>Deregister</h2>
				</div> <!-- end top -->
				<div class="middle_box_big">
					<label>If you want to delete your account press on the following link. <a href="deregister.php" onclick="return confirmMessage(this)"> Delete My Account.</a> All your data will be lost.</label>
				</div> <!-- end middle_big -->
				<div class="bottom_box"> 
														
				</div> <!-- end bottom -->
			</div> <!-- end right -->
		<!-- /////// -->			
        
		</div><!-- end wrap -->
	</div> <!-- end container -->
	
<!-- 
 *************************************************************
 *	DWEB Re-assessment 2012
 ************************************************************* 
 -->

</body>
</html>