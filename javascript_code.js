<!--

/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/
-->

<!-- index.php -->

    //this function is called when the user click in some of the textfields. It display and hide messages.
	function showInfo(focusedElement) 
	{
		if(focusedElement == document.getElementById('handle'))
		{
			document.getElementById('handleInfo').innerHTML = "This is the name you will be known on Buzzer.";
		}
		else if(focusedElement == document.getElementById('password'))
		{
			//display the info message onfocus
			var message = "*For a more secure password use letters, digits or symbols like \"_\" or \".\".";
			createLabel('picturediv',message,'passwordInfo');
			
			//on focus remove the error message(length of password) 
			if(!(document.getElementById('password').value.length>=6 && document.getElementById('password').value.length<=20))
			{
				removeLabel('picturediv2');//removes the label from the div picturediv2
				removeImage('picturediv2');//removes the image from the div picturediv2
			}
		}	
		else if(focusedElement == document.getElementById('confPass'))
		{
			//on focus remove the error message(length of password) 
			if(!(document.getElementById('confPass').value.length>=6 && document.getElementById('confPass').value.length<=20))
			{
				removeLabel('picturediv3');//removes the label from the div picturediv3
				removeImage('picturediv3');//removes the image from the div picturediv3
			}	
		}
	}
	
	//this function is called when the user click out of some textfields. It display and hide messages.
	function hideInfo(onBlurElement)
	{
		if(onBlurElement == document.getElementById('handle'))
		{
			document.getElementById('handleInfo').innerHTML = "";//on blur disappear the information text under the textbox
		}
		else if(onBlurElement == document.getElementById('password'))
		{
			//on blur delete the label(the info text about the password) under the textbox
			removeLabel('picturediv');
			//if the length of the password isn't from 6 to 20 characters
			if(!(document.getElementById('password').value.length>=6 && document.getElementById('password').value.length<=20))
			{
				//create the attention image.
				createImg('picturediv2');
				//create a label with the error message.
				var message = "Your password should be 6 to 20 characters long.";
				createLabel('picturediv2',message,'wrongPassInfo1');
			}
		}
		else if(onBlurElement == document.getElementById('confPass'))	
		{
			if(!(document.getElementById('confPass').value.length>=6 && document.getElementById('confPass').value.length<=20))
			{
				//create the attention image.
				createImg('picturediv3');
				//create a label with the error message.
				var message = "Your password should be 6 to 20 characters long.";
				createLabel('picturediv3',message,'wrongPassInfo2');
			}
		}
	}
	
	//This function creates a label inside the given div(id of the div)
	function createLabel(id,message,labelname)
	{
		var label = document.createElement("label");
		label.setAttribute('id', labelname);
		label.innerHTML = message;
		document.getElementById(id).appendChild(label);
	}
	
	//This function creates the Attention image inside the given div(id of the div)
	function createImg(id)
	{
		var img = document.createElement("img");
		img.setAttribute('alt', 'attention');
		img.setAttribute('width', '20px');
		img.setAttribute('src', 'images/attention!.png');
		document.getElementById(id).appendChild(img);
	}
	
	//this function removes the label from the given div
	function removeLabel(id) {
    	document.getElementById(id).removeChild(document.getElementById(id).getElementsByTagName('label')[document.getElementById(id).getElementsByTagName('label').length - 1]);
	}
	
	//this function removes the image from the given div
	function removeImage(id) {
    	document.getElementById(id).removeChild(document.getElementById(id).getElementsByTagName('img')[document.getElementById(id).getElementsByTagName('img').length - 1]);
	}
	
	//on button click(submit form) check the form
	function onCr_AcClick()
	{
		if(document.getElementById('submitCrAc'))//when the button for create account is pressed 
		{
			//check if all the fields of the form are filled 
			if(document.getElementById('handle').value == "" || document.getElementById('password').value == ""  || document.getElementById('confPass').value == "" )
			{
				alert("Please fill all the required fields.");//display message!
				return false;
			}
			
			//check if there are special characters in the handle.
			//http://psacake.com/web/jb.asp from this source: http://psacake.com/web/jb.asp. 
			var iChars = "!@#$%^&*()+=-[]\\\';,/{}|\":<>?~";
			for (var i = 0; i < document.getElementById('handle').value.length; i++) 
			{
				if(iChars.indexOf(document.getElementById('handle').value.charAt(i)) != -1)
				{
  	  				alert ("You have entered invalid characters. Please use characters, numbers, or symbols like \"_ \" or \".\" for your nickname and your password.");
  					return false;
  				}
			}
			
			//check if there are special characters in the password.
			for (var i = 0; i < document.getElementById('password').value.length; i++) 
			{
				if(iChars.indexOf(document.getElementById('password').value.charAt(i)) != -1)
				{
  	  				alert ("You have entered invalid characters. Please use characters, numbers, or symbols like \"_ \" or \".\" for your nickname and your password.");
  					return false;
  				}
			}
  				
			//check if the password in the password field is the same with the password in the confirm password field.
			if(!(document.getElementById('password').value  == document.getElementById('confPass').value) )
			{
				alert("Passwords do not match. ");//display message!
				return false;
			}
			//check if the length of the password is between 6 to 20
			if(!(document.getElementById('password').value.length>=6 && document.getElementById('password').value.length<=20))
			{
				alert("Your password should be 6 to 20 characters long. Please give another password.");//display message!
				return false;
			}
		}
		return true;
	}
		
	function onLogInClick()
	{
			//check if all the fields of the form are filled 
			if(document.getElementById('handleLogIn').value == "" || document.getElementById('passwordLogIn').value == "")
			{
				alert("Please fill all the required fields to Log In.");//display message!
				return false;
			}	
			else 
				return true;		
	}
<!-- index.php -->


<!-- account.php -->
<!--Code to clear the initial text in the textarea, when the user clicks on it. The code clears ONLY the initial text of the textarea--> 
	function clearContainingText(profileText) {
		if(profileText.value == "Enter your new Profile...")
		{
			profileText.value = "";
		}
		document.getElementById("changeProfileInfo").innerHTML = "";
	}
<!--When the focus is moved away from that particular text area and there is no text displayed in it the default message is appeared again.--> 
	function addDefaultTextOnEmpty(profileText) {
		if(profileText.value=="")
		{
			profileText.value = "Enter your new Profile...";
		}
	}

//This function returns a confirm message to the user. If he really wants to deregister or not.
function confirmMessage(deregisterLink)
{
		if (confirm("Are you sure you want to deregister from Buzzer? Your account will be deleted.")) 
		{ 
			return true;
		}	
		else 
			return false;	
}
<!-- account.php -->

<!-- home.php -->
<!--Code to clear the initial text in the textarea, when the user clicks on it. The code clears ONLY the initial text of the textarea--> 
	function clearContainingTexthome(buzzText) {
		if(buzzText.value == "Enter your Buzz...")
		{
			buzzText.value = "";
		}
		document.getElementById("postMyBuzzInfo").innerHTML = "";
	}
<!--When the focus is moved away from that particular text area and there is no text displayed in it the default message is appeared again.--> 
	function addDefaultTextOnEmptyhome(buzzText) {
		if(buzzText.value=="")
		{
			buzzText.value = "Enter your Buzz...";
		}
	}

//http://www.mediacollege.com/internet/javascript/form/limit-characters.html -->source	
	function maxCharactershome(buzztext, maxnum) {
	if (buzztext.value.length > maxnum) {
		buzztext.value = buzztext.value.substring(0, maxnum);
	} else {
		document.getElementById('counter').innerHTML = maxnum - buzztext.value.length;
	}
}
<!-- home.php -->

<!-- profile.php -->
	function createLabelMaxChar()
	{
		var msg = "You have "
		createLabel('remainingCharacters',msg,'youHave');
		var msg2 = "141";
		createLabel('remainingCharacters',msg2,'counter');
		var msg3 = " characters left."
		createLabel('remainingCharacters',msg3,'charactersLeft');
	}

<!-- profile.php -->

<!-- All pages -->
//function checkking if the search box is empty when the user presses the search button.
function emptySearch()
{
	if(document.getElementById('SearchName').value == "")
	{
		return false;//return false to the form, the form is not submitted
	}
	else 
		return true;
}
<!-- All pages -->

<!--
/*************************************************************
 *	DWEB Re-assessment 2012
 *************************************************************/
-->