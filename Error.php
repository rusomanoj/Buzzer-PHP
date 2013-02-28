<?php 
/*************************************************************
 *	
 *************************************************************/

	//Start session
	session_start();
	
	//if(!(isset($_SESSION['SESS_USERID']))) 
	//{
    	//header("location: index.php");
		//exit();
	//}
	
	$redirect_page = $_SESSION['SESS_ONERRORREDIRECT']; //the page to redirect depenging on the error.
	$message = $_SESSION['SESS_ONERRORMESSAGE']; //the message to print depending on the error.
	$page_title = $_SESSION['SESS_PAGETITLE']; // title of the page
	$adviceMessage = $_SESSION['SESS_ADVMESSAGE']; //
	
	//Include extra functions
	require_once 'DWEB_Extra_functions.php';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buzzer</title>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container" class="container"> 
		<div id="header" class="header">
				<div align="center"><img src="images/Buzzer_logo.jpg" alt="Buzzer_logo"/> </div>
				<div id="title" class="top_box_header">
					<h2><?=$page_title?></h2> <!-- Error Message! -->
				</div> <!-- end title class="top_box_header" -->
				<div class="bottom_box_header">
					<div>
						<label> <?php print"$message" ?> <a href="<?=$redirect_page?>"><?=$adviceMessage?></a> </label>
                        <?php //unset($_SESSION['SESS_ONERRORREDIRECT']);
						      //unset($_SESSION['SESS_ONERRORMESSAGE']); ?>
					</div>
				</div> <!-- end bottom_box_header -->
		</div> <!-- end header class="header"-->
		
		<div class="wrap">
		<!-- /////// -->
        </div>
     </div><!-- end container class="container"-->

<!-- *************************************************************
 *	
 ************************************************************* -->

</body>
</html>