<!--
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/
-->
		<!-- /////// -->
			<div id="leftSide" class="left"> 
				<div id="leftSideTitle" class="top_box"> 
					<?php 
						print" <h2>".handle($UserID). "</h2>";
					?>
				</div> <!-- end leftSideTitle class="top_box" -->
				<div id="leftsideContent" class="middle_box_small">
                <!-- Here is the side bar menu. The submenu is applied to that but in order to disable the links when they are in active state we use and if                     statement in php. If the link is selected(variables: $Sel_style1, $Sel_style2, $Sel_style3 are equal to check - not empty) dispaly the                     link as a simple text with yellow color(span has the yellow colllor)-->
					<div id="submenuNavigation" class="submenu">
						<ul>
							<li>
                            	<?php if($Sel_style1=="check"){?>
									<span>Followers</span>		
                                <?php }else {?>			
                                	<a class="<?=$Sel_style1?>" id="selStyle1" href="profile.php?sel=1">Followers</a>
                                <?php }?>
							</li>
							<li>
                            	<?php if($Sel_style2=="check"){?>
                                	<span>Following</span>
                                <?php }else {?>			
                                	<a class="<?=$Sel_style2?>" id="selStyle2" href="profile.php?sel=2">Following</a>
                                <?php }?>				
							</li>
							<li>
                            	<?php if($Sel_style3=="check"){?>
                                	<span>My Buzzes</span>	
                                <?php }else {?>			
                                	<a class="<?=$Sel_style3?>" id="selStyle3" href="profile.php?sel=3">My Buzzes</a>	
                                <?php }?>			
							</li>
			    		</ul>
                  	</div> <!-- end submenuNavigation -->
                    <br />
                     <div id="search" align="center" style="border-top:double; border-bottom:double; width:100%; border-color:#FFFFFF;"> <!-- Search div -->
                     	<form id="searchBuzzers" method="get" action="search.php" onsubmit="return emptySearch()">
					   		<label style="font-size:16px" for="SearchName">
                        		<br />Search People :<br />
							</label>
                        	<input id="SearchName" type="text" size="24" value="<?=$searchHandle?>" name="SearchName" style="margin-top:10px;"/>
							<br />
                        	<div align="center" style="width:100%"> <!-- search button-->
								<input type="submit" value="Search" name="Submit" style="margin-top:20px;"/>
							</div> <!-- end search button-->
                        	<br />
                      	</form>
					 </div> <!-- end Search div -->
				</div> <!-- end leftsideContent class="middle_box_small" -->
                <div id="leftSideBottom" class="bottom_box"> 
										
			    </div> <!-- end leftSideBottom class="bottom_box" -->
			</div> <!-- end leftSide class="left" -->
		<!-- /////// -->
<!--
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/
-->