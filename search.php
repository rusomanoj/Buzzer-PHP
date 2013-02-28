<?php

/*************************************************************
 *	
 *************************************************************/

$thisfile = $_SERVER['PHP_SELF'];

//start session
session_start();

//read the SearchName from the page that called this page 
if($_GET['SearchName']!="")
{ 
	$searchHandle = $_GET['SearchName']; 
}
//when the page is reloaded chech if the $_GET['SearchName'] is empty or not. If it is empty take the value from the session.
else if ($_SESSION['searchval'] != NULL )
{ 
	$searchHandle = $_SESSION['searchval']; 
	unset($_SESSION['searchval']);
}
else 
{
	$_SESSION['searchval'] = $searchHandle;
}

//if the $_SESSION['SESS_USERID'] is empty(no user logged in) trap the user in index page.
if(!(isset($_SESSION['SESS_USERID']))) 
{
    header("location: index.php");
	exit();
}

//when pressing the buttons follow and unfollow in this page reload this url. Depending on which link is selected. Action in followUnfollow form.
$url = $_SERVER['PHP_SELF'].'?'.'SearchName='.$searchHandle;

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
<script type="text/javascript" src='javascript_code.js'></script>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container"> 
		<div class="header">
				<div align="center"><img src="images/Buzzer_logo.jpg" alt="Buzzer_logo"/> </div>
				<div class="top_box_navigation">
					<div class="menu">
						<ul class="leftMenu">
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
                            	<a href="account.php">Account</a>
                            </li>
                            <li class="last" >
                    			<a href="logOut.php">Log Out</a>
                            </li>
                        </ul> 
			  		</div> <!-- end menu -->
                  </div> <!-- end top_box_header -->
                  <div class="bottom_box_header">
					  Search  
				  </div> <!-- end bottom_box_header -->
		</div> <!-- end header -->
		
		<div class="wrap">
        
<!-- LEFT_SIDE -->		
<?php //Include the left side of the page. (Links for followers, following, buzzes, Search engine).
require_once 'left_side.php'; ?>
<!-- END LEFT_SIDE -->

			<div class="right">
				<div class="top_box">
					<h2>Search Results</h2>
				</div> <!-- end top -->
				<div class="middle_box_big">
                	<?php 
					 //filters
					 $searchHandle = trim ($searchHandle); //This removes the empty spaces at the beggining and at the end of the string
					 $searchHandle = strip_tags($searchHandle); //This removes any parts of the code the user has tried to enter.
					 //If the searched handle is not empty
					 if(!$searchHandle == "")
					 {
					    $searchResults = searchPeople($searchHandle);//return all the user Handles that match with the searched one.
						if (is_array($searchResults))//we chech if it is an array.
						{ 
							//Include the code that produces the list of people(Handle, profile, button(follow-unfollow)). 
							require_once 'listPeople.php'; 
						}
					    else//if the function returrns no results. No matches.
					    {
							print"<h2>No Results were found. You Searched for: \"$searchHandle\".</h2>";
						}
				 	}
				 	else//if the page is called without a value for search.
		       	 	{
					 	print"<h2>Please enter something to search for.</h2>";
				 	}	
					?>	
							
				</div> <!-- end middle_big -->
				<div class="bottom_box"> 
														
				</div> <!-- end bottom_box -->					
			</div> <!-- end right -->
		<!-- /////// -->			
        
	</div><!-- end wrap -->
</div> <!-- end container -->

<!--
/*************************************************************
 *	
 *************************************************************/
-->
</body>
</html>
