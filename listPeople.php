<?php
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

foreach($searchResults as $value)//for each user(result of function searchPeople()) find the handle and the profile. 
{
	$usersHandle = handle($value);//returns the handel of the user.
	$usersProfile = profile($value);//returns the profile of the user.
	//Also make sure that the same user is not returned. The users can not follow themselves.
		if($value != $UserID)
		{
			$resultOfFollows = follows($UserID, $value);
    		if($resultOfFollows == 1)//if the user is following the user that the function search returned.
    		{
        		$valueOfButton = "UnFollow";//make the value of the button unfollow
			}
			else if($resultOfFollows == 0)//if the user is not following the returned user.
			{
				$valueOfButton = "Follow";//make the value of the button follow
			}
			else if($resultOfFollows == -1)//on error(if the follows function return -1)
			{
				error("The function follows has returned -1. Error!!!");//message for the admin.
			}
			if($usersProfile == NULL && $usersProfile!=" ")
			{
				//error("$thisfile: Could not return the profile. (8)");
			}
			?>

	<div style="border-bottom:double; width:100%; border-color:#FFFFFF;">
		<form name="followUnfollow" action="<?=$url?>" method="post">
        	<div class="top_box">
				<h2><label><?php print"$usersHandle"; ?></label></h2>
                <input type="hidden" name="hiddenPreyUid" value="<?=$value?>" />
                <?php 
				if($UserID != 0)//if the logged in user is NOT the admin show the button follow - unfollow.
				{ 
				?>
				<div style="float:right"><!--div for the button follow unfollow-->
					<input style="display:inline; margin-top:20px;" type="submit" value="<?=$valueOfButton?>" name="submitFollowUnfollow"/> <!--onclick="followUnfollow(this)"-->
				</div><!--end div for the button follow unfollow-->
                <?php 
				}
				?>
			</div> <!-- end top_box --> 
            <div class="middle_box_medium"> 
                <?php print"$usersProfile";?>
            </div> <!-- end middle_box_medium-->
            <div class="bottom_box">
            </div> <!-- end bottom_box-->
        </form>
	</div>
<?php	
		}
}

/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/

?>