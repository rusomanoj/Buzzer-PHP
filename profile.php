<?php
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

$thisfile = $_SERVER['PHP_SELF'];
//start session
session_start();

//read the selected link(follower, following, MyBuzzes) in profile page.
$selection=$_GET['sel']; 

//clear the session. This session contains the previous searched value.
unset($_SESSION['searchval']);

//on reload read the link choice which is saved in the session(SESS_SELECT).
if ( $selection==NULL  && $_SESSION['SESS_SELECT'] != NULL )
{ 
	$selection = $_SESSION['SESS_SELECT']; //retrieve the data from the session
	unset($_SESSION['SESS_SELECT']);//clear the session(destroy).
}
else 
{
	$_SESSION['SESS_SELECT'] == $selection;//save selection in a session.
}

//when pressing the buttons follow and unfollow in this page reload this url. Depending on which link is selected. Action in followUnfollow form.
$url = $_SERVER['PHP_SELF'].'?'.'sel='.$selection;

//if the $_SESSION['SESS_HANDLE'] is empty(no user logged in) trap the user in index page.
if(!(isset($_SESSION['SESS_USERID']))) 
{
    header("location: index.php");//redirect here.
	exit();
}

$UserID = $_SESSION['SESS_USERID']; 

//Include provided functions
	require_once '/n/www/student/projects/dweb-shared/DWEBfunctions.php';
	
//Include extra functions
require_once 'DWEB_Extra_functions.php';	

//Include the follow unfollow functionality. The user can follow or unfollow users.
require_once 'followUnfollow.php'; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buzzer</title>
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
							    <span>Profile</span>					
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
				</div> <!-- end top_box_header -->
				<div class="bottom_box_header">
       				<!-- Bread Crumb -->
					<?php if($selection == 1)
					      {
							  print"<a href=\"profile.php\">Profile</a> > Followers";
							  $Sel_style1 = "check";//when the link is selected dispaly link, display it as simple text.
					   	  }
						  else if($selection == 2)
						  {
							  print"<a href=\"profile.php\">Profile</a> > Following";
							  $Sel_style2 = "check";//when the link is selected dispaly link, display it as simple text.
						  }
						  else if($selection == 3)
						  {
							  print"<a href=\"profile.php\">Profile</a> > My Buzzes";  
							  $Sel_style3 = "check";//when the link is selected dispaly link, display it as simple text.
						  }
						  else 
						  	  print"Profile";
				    ?>
				</div> <!-- end bottom_box_header -->
		</div> <!-- end header -->

<div class="wrap">
<!-- LEFT_SIDE -->		
<?php //Include the left side of the page. (Links for followers, following, buzzes, Search engine).
require_once 'left_side.php'; ?>
<!-- END LEFT_SIDE -->	

<div class="right">
<!-- right top big box(handle of user and profile) -->
				<div class="top_box">
					<?php 
						print" <h2>Profile</h2>"; //print" <h2>".handle($UserID)."</h2>";
					?>
				</div> <!-- end top_box -->
				<div class="middle_box_big">
					<label>
						<?php print profile($UserID);?>
                    </label> 
		        </div> <!-- end middle_box_big -->
				<div class="bottom_box" align="right"> 
                	<label><a href="account.php">Change Your Profile</a></label>							
				</div> <!-- end bottom_box -->
<!--  END right top big box(handle of user and profile) -->

                	<?php 
					if($selection == 1)
					{?>
						<div class="top_box">
						<h2>Followers</h2>
						</div> <!-- end top_box -->
						<div class="middle_box_big">	
                    <?php
						$searchResults = myFollowers($UserID);//returns all people that follow the user.
						if (is_array($searchResults))//if the user has followers
						{
							//Include the code that produces the list of people(Handle, profile, button(follow-unfollow)). 
							require_once 'listPeople.php';  
						}
						else//if there are no people following the user
						{
							print"<h2>You have no followers.</h2>";
						}
						print"</div> <!-- end middle_box_big -->";
						print"<div class=\"bottom_box\"> 
							  </div> <!-- end bottom_box -->";
					}
					if($selection == 2)
					{?>
                    	<div class="top_box">
						<h2>Following</h2>
						</div> <!-- end top_box -->
						<div class="middle_box_big">
                    <?php
						$searchResults = myFollowings($UserID); //returns all the people that the user is following.
						if (is_array($searchResults))//If the user follows some people
						{ 
							//Include the code that produces the list of people(Handle, profile, button(follow-unfollow)). 
							require_once 'listPeople.php'; 
						}
						else//if the user does not follow anyone
						{
							print"<h2>You are not following anyone! Search for people!</h2>";
						}
						print"</div> <!-- end middle_box_big -->";
						print"<div class=\"bottom_box\"> 
							  </div> <!-- end bottom_box -->";
					}
					if($selection == 3)
					{ ?>
                    	<div class="top_box">
						<h2>My Buzzes</h2>
						</div> <!-- end top_right -->
						<div class="middle_box_big">
                	<?php					
					$result = myBuzzes($UserID); // the function myBuzzes returns all the Buzzes
					if(!mysql_num_rows($result)==0)
					{
					  while($row = mysql_fetch_array($result))
					  { 
						  $userhandle = handle($UserID);
						  print" 
						  <div style=\"border-bottom:double; width:100%; border-color:#FFFFFF;\">
							  <div class=\"top_box\">
								<div>
									<h2>$userhandle | <font size=\"1\" color=\"#EAA61A\"> $row[timestamp]</font></h2> 
								</div> 
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
						print"<h2>You have no buzzes.</h2>";
					}
					
   						print"</div> <!-- end middle_box_big -->";
						
						print"<div class=\"bottom_box\"> 
							  </div> <!-- end bottom_box -->";
					}
					?> 
                					
  		</div> <!-- end right -->
		<!-- /////// -->			
        
	</div><!-- end wrap -->
</div> <!-- end container --> 

<!--
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/
-->
</body>
</html>
