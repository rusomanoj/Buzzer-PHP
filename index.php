<?php 
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

$thisfile = $_SERVER['PHP_SELF'];
session_start();

//if a user is logged do not permit him/her to go back to the index page(log in form)
if(isset($_SESSION['SESS_USERID']))
{
    header("location: home.php");
	exit();
} 
////////////////////////////////////////////
	//include the given functions.
	require_once '/n/www/student/projects/dweb-shared/DWEBfunctions.php';
	//Include extra functions.
	require_once 'DWEB_Extra_functions.php';
///////////////////////////////////////////////
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
	<div id="container" class="container"> 
         <div id="heading" class="header">
              <div id="logo" align="center"><img src="images/Buzzer_logo.jpg" alt="Buzzer_logo"/> </div>
              <div class="top_box_header">
                  <h2>Welcome!</h2>
              </div> <!-- end top_box_header -->
              <div class="bottom_box_header">
                  <div>
                      <label> Welcome to Buzzer. Create an account or Log In to live the social experience. </label>
                  </div>
              </div> <!-- end bottom_box_header -->
          </div> <!-- end header -->
		
          <div class="wrap">
          <!-- /////// -->
            <div class="center2"> 
                <div class="top_box">
                    <h2>Create Account</h2>
                </div> <!-- end top_box -->
                <div class="middle_box_medium">
                  <form name="createAcount" action="registration_control.php" method="post" onsubmit="return onCr_AcClick();">
                      <label>*NickName :<br /></label>
                      <input id="handle" type="text" onfocus="showInfo(this)" onblur="hideInfo(this)" size="58" value="" name="handle" style="margin-top:10px;"/>
                      <br />
                      <label for="handle" id="handleInfo"></label>
                      <br />
                      <label for="password">*Password :<br /></label>
                      <input id="password" type="password" onfocus="showInfo(this)" onblur="hideInfo(this)" size="58" value="" name="password" style="margin-top:10px;"/>
                      <br />
                      <!-- Div for the info message /Password/ -->
                      <div id="picturediv">
                      
                      </div>
                      <!-- Div for the error message /Password/ -->
                      <div id="picturediv2">
                      
                      </div>
                      <br />
                      <label for="confPass">*Confirm Password :<br /></label>
                      <input id="confPass" type="password" size="58" onfocus="showInfo(this)" onblur="hideInfo(this)" value="" name="confPass" style="margin-top:10px;"/>
                      <br />                      
                      <div id="picturediv3">
                      
                      </div>
                      <br />
                      <label>Profile Text :<br />
                      </label>
                      <textarea rows="4" cols="44" id="profText" name="profText" style="margin-top:10px; height:50px"></textarea>
                      <br />
                      <div align="center" style="width:100%"> <!-- create account button-->
                          <input type="submit" value="Create Account" id="submitCrAc" name="submitCrAc" style="margin-top:20px;" />
                          <br/>
                          <br/>
                      </div> <!-- end create account button-->
                  </form>
                </div> <!-- end middle_box_medium -->
                <div class="bottom_box"> 
                    <div style="padding-left:7px">
                        <label style="color:#EAA61A">*All fields with the "*" are required.</label>
                    </div>		
                </div> <!-- end bottom_box -->
            </div> <!-- end center2 -->
          <!-- /////// -->
            <div class="center2">
                <div class="top_box">
                	<h2>Log In</h2>
                </div> <!-- end top_box -->
                <div class="middle_box_medium">
                  <form name="logIn" action="login_control.php" method="post" onsubmit="return onLogInClick();">
                      <label for="handleLogIn">NickName :<br />
                      </label>
                      <input id="handleLogIn" type="text" size="58" value="" name="handleLogIn" style="margin-top:10px;"/>
                      <br />
                      <br />
                      <label for="passwordLogIn">Password :<br />
                      </label>
                      <input id="passwordLogIn" type="password" size="58" value="" name="passwordLogIn" style="margin-top:10px;"/>
                      <br />
                      <div align="center" style="width:100%"> <!-- login button-->
                          <input type="submit" value="Log In" id="submitLogIn" name="submitLogIn" style="margin-top:20px;"/>
                      </div> <!-- end login button-->
                  </form>
                </div> <!-- end middle_box_medium -->
                <div class="bottom_box"> 
                                                        
                </div> <!-- end bottom_box -->				
            </div> <!-- end center2 -->
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
