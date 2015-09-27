<?php 
session_start();
require_once('configure.php');
require_once('functions.php');




if(isset($_GET['scode']))
{
$scode=cleanQuery($_GET['scode']);
if($scode!=$_SESSION['security_code'])
{
echo '<div class="error" style="width:160px; margin:0">Incorrect Security Code</div>';
}
else
{
echo "";
}
}
if(isset($_GET['email']))
{
	$email2= cleanQuery($_GET['email']);
	
	if (isValidEmail($email2))
	{
		if($email2=="")
		{
			//echo '<div class="error">Please type Email ID</div>';
		}
		else
		{
			$sql="select * from users where email= '". $email2. "'";
			$result=mysqli_query($mysqli, $sql);
		
			if(mysqli_num_rows($result) == 0)
			{	
				echo '<div class="success">Email ID is available</div>';
			} 
			else
			{
				echo '<div class="error">Email Id Already Registered. Please <a href="login.php">login</a> with your email.</div>';
			}
		}
	}
	else
	{
		if($email2!="")
		{
			echo '<div class="alert">Invalid email Address.</div>';
		}
	}
}
if(isset($_GET['emailr']))
{
	$email2= cleanQuery($_GET['emailr']);
	
	if (isValidEmail($email2))
	{
		if($email2=="")
		{
			//echo '<div class="error">Please type Email ID</div>';
		}
		else
		{
			$sql="select * from users where email= '". $email2. "'";
			$result=mysqli_query($mysqli, $sql);
		
			if(mysqli_num_rows($result)!= 0)
			{	
				echo '<div class="error" id="errorr" >Email Id Already Registered.</div>';
			} 
			else 
			{
			$sql1="select * from referrals where email= '". $email2. "'";
			$result1=mysqli_query($mysqli, $sql1);
			if(mysqli_num_rows($result1) != 0)
			{	
				echo '<div class="error">Email Id Already Reffered.</div>';
			} 
			}
		}
	}
	else
	{
		if($email2!="")
		{
			echo '<div class="alert">Invalid email Address.</div>';
		}
	}
}
if(isset($_GET['contact']))
{
	$contact2= cleanQuery($_GET['contact']);
	
	
		if($contact2=="")
		{
			//echo '<div class="error">Please type Email ID</div>';
		}
		else
		{
			$sql="select * from contacts where contact= '". $contact2. "'";
			$result=mysqli_query($mysqli, $sql);
		
			if(mysqli_num_rows($result) == 0)
			{	
				echo '<div class="success">Contact available</div>';
			} 
			else
			{
				echo '<div class="error">Contact Already Exists</div>';
			}
		}
	
}   
?>
