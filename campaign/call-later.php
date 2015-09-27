<?php include("includes/app_top.php");
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$campaign = $_SESSION['campaign'];
$campaigninfo = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * from campaigns where name='$campaign'"));
$constituency = $campaigninfo['constituency'];
$options=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * from categories where id=".$categoryid));


$getid= getid('rid');
checkUserLogin();
if($action=="send2")
{
    $wrong=cleanQuery($_POST['wrong']);
    $vote=cleanQuery($_POST['vote']);
    $volunteer=cleanQuery($_POST['volunteer']);
    $booth=cleanQuery($_POST['booth']);
    $voteridnumber=cleanQuery($_POST['voteridnumber']);
    $buzz=cleanQuery($_POST['buzz']);
    $call=cleanQuery($_POST['call']);
    $jansabha=cleanQuery($_POST['jansabha']);
    $donate=cleanQuery($_POST['donate']);
    $comments=cleanQuery($_POST['comments']);
    $_SESSION['getcontact']='';
    $getid=cleanQuery($_POST['cid']);
    if($wrong==1)
    {
        $query="update ".$tablename." set userid=".$_SESSION['userid'].", voterid=1, iscalled=$wrong, contactdate='$date', vote=$vote, volunteer=$volunteer, booth=$booth, voteridnumber='$voteridnumber', buzz=$buzz, `call`=$call, jansabha=$jansabha, donate=$donate, comments='$comments' where id=".$getid;
        mysqli_query($mysqli, $query) or die(mysqli_error());
        //echo $query;
        tep_redirect("call-later.php?action1=s1");
    }
    else if($wrong==2 ||$wrong==4)	
    {
        $query="update ".$tablename."  set iscalled=$wrong,  contactdate='$date',  userid=".$_SESSION['userid'].", comments='$comments' where id=".$getid;
        mysqli_query($mysqli, $query);		
        //echo $query;
        tep_redirect("call-later.php?action1=s3");
    }
    else if($wrong==3)	
    {
        $query="update ".$tablename."  set iscalled=$wrong, userid=".$_SESSION['userid'].", contactdate='$date', comments='$comments' where id=".$getid;
        mysqli_query($mysqli, $query);
        tep_redirect("call-later.php?action1=s4");
    }
    else if($wrong==5)	
    {
        $query="update ".$tablename."  set iscalled=$wrong, userid=".$_SESSION['userid'].", contactdate='$date', comments='$comments' where id=".$getid;
        mysqli_query($mysqli, $query);
        tep_redirect("call-later.php?action1=s9");
    }
    else
    {
        tep_redirect("call-later.php?action1=s2");
    }
}
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
<script type="text/javascript">
$(document).ready(function(){
check1();

$("#comments").keyup(function(){
	maxlength=140;
    if($(this).val().length > maxlength){
        $(this).val($(this).val().substr(0,maxlength));
	}
  $("#count").text("Characters left: " + (maxlength - $(this).val().length));
});		
});

function check1() {
s=getCheckedRadio('wrong');
if(s==1)
document.getElementById("voter").style.display="block";
else
document.getElementById("voter").style.display="none";
}

function check3() {	
if (document.getElementById('vote1')) {
s=getCheckedRadio('vote');	
if(s==1)
{
alert("Update the contact details and Click submit button to save the details.");
return false;
}
else
{
alert("Click submit button to confirm.");
return false;
}
}
else
{
document.getcontact.submit();
}
} 
</script>
</head>
<body>
 <?php include("includes/header.php");?> 
            <div class="division-1">
           <h1>Call Later's List</h1>
           <div id="messages">
           	<?php 
			 
			    if($action1=="s3")
		   {echo '<div class="error">This Number will skip.</div>';
			   }
			    if($action1=="s4")
		   {echo '<div class="alert">This Number was placed in Call Later. Correspond him later.</div>';
			   }
			   if($action1=="s1")
		   {echo '<div class="success">Updated contacted details.</div>';
			   }
			   if($action1=="s2")
		   {echo '<div class="error">The Earlier Number was recycled back into the system.</div>';
			   }
			?>
           </div>
         
         <?php
$daystart=$date2." 08:00:00";
$dayend=$date2." 22:00:00";
$date = date_default_timezone_set('Asia/Kolkata');
$now=date("Y-m-d G:i:s");
//echo $daystart.', '.$dayend.', '.$now;
if(check_date_is_within_range($daystart, $dayend, $now)){
		    if($action =="call")
{
           $sql1="SELECT * FROM  ".$tablename."   WHERE id=".$getid." and userid=".$_SESSION['userid'];	
	$res=mysqli_query($mysqli, $sql1);
	//echo $sql1;
	if(mysqli_num_rows($res) >0)
	$row=mysqli_fetch_assoc($res);	
    ?>
    <div class="clearfix overflow_x-a">
	<table class="tabc" align="center" >
    	<tr>
    	  <td height="6" colspan="6"></th>
  	  </tr>
    	<tr> 
        <th>Contact&nbsp;Number&nbsp;&nbsp;</th>         	
        	<td ><?php echo $row['contact'];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <th>Contact&nbsp;Name&nbsp;&nbsp;</th>         	
        	<td ><?php echo $row['contactname'];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <th>City&nbsp;&nbsp;</th> <td><?php echo ($row['city']!='')?$row['city']:$row['address'];?></td>
            
        </tr><tr>
    	  <td height="6" colspan="6"></th>
  	  </tr>
    </table>
<div class="checklist" style="width:90%; margin:0 auto">
<form method="post" action="call-later.php?action=send2" onSubmit="return validate2(this)">
    <p><strong>Did the call get connected ?</strong><br />
        <input type="radio" name="wrong" value="1" id="wrong1" onClick="check1();" checked="checked" /> Yes &nbsp;&nbsp;
        <input type="radio" name="wrong" value="4" id="wrong2" onClick="check1();" /> Not Reached &nbsp;&nbsp;
        <input type="radio" name="wrong" value="2" id="wrong3" onClick="check1();" /> Wrong Number &nbsp;&nbsp;
        <input type="radio" name="wrong" value="3" id="wrong4" onClick="check1();" /> Call Later</p>
    <div id="voter" style="display:none">
        <p><strong>Will vote for Aam Aadmi Party? </strong><br />
            <input type="hidden" name="cid" value="<?php echo $row['id'];?>" />
            <input type="radio" name="vote" value="1" id="vote1" checked="checked" /> Yes &nbsp;&nbsp;
            <input type="radio" name="vote" value="0" id="vote2" /> No &nbsp;&nbsp;
            <input type="radio" name="vote" value="2" id="vote3" /> Undecided</p>
        <div id="volunteer" <?php echo ($options['volunteer']==0 ? 'style="display:none"' : '');?>>
            <p><strong>Willing to volunteer?</strong> <br />
                <input type="radio" name="volunteer" value="1" id="volunteer1"  /> Yes &nbsp;&nbsp;
                <input type="radio" name="volunteer" value="0" id="volunteer2" checked="checked" /> No</p>
        </div>
        <div id="booth" <?php echo ($options['booth']==0 ? 'style="display:none"' : '');?>>
            <p><strong>Volunteer on election day for booth-related activites?</strong> <br />
                <input type="radio" name="booth" value="1" id="booth1"  /> Yes &nbsp;&nbsp;
                <input type="radio" name="booth" value="0" id="booth2" checked="checked" /> No &nbsp;&nbsp;
                <input type="radio" name="booth" value="2" id="booth3"  /> Undecided<br />
                <strong style="color:red">VoterID / Polling Booth Name / Ward Number:</strong>&nbsp;<input type="text" id="voteridnumber" name="voteridnumber" maxlength="20" /></p>
        </div>
        <div id="buzz" <?php echo ($options['buzz']==0 ? 'style="display:none"' : '');?>>
            <p><strong>Volunteer for Buzz Campaign?</strong> <br />
                <input type="radio" name="buzz" value="1" id="buzz1"  /> 1 Week &nbsp;&nbsp;
                <input type="radio" name="buzz" value="2" id="buzz2"  /> 1 Weekend &nbsp;&nbsp;
                <input type="radio" name="buzz" value="0" id="buzz3" checked="checked" /> No</p>
        </div>
        <div id="call" <?php echo ($options['call']==0 ? 'style="display:none"' : '');?>>
            <p><strong>Pledge to call 10 friends/relatives?</strong> <br />
                <input type="radio" name="call" value="1" id="call1"  /> Yes &nbsp;&nbsp;
                <input type="radio" name="call" value="0" id="call2" checked="checked" /> No </p>
        </div>
        <div id="jansabha" <?php echo ($options['jansabha']==0 ? 'style="display:none"' : '');?>>
            <p><strong>Organize a jan sabha (ward/mohalla/gali/apartment etc) for the AAP candidate? </strong> <br />
                <input type="radio" name="jansabha" value="1" id="jansabha1" /> Yes &nbsp;&nbsp;
                <input type="radio" name="jansabha" value="0" id="jansabha2" checked="checked"/> No </p>
        </div>
        <div id="donate" <?php echo ($options['donate']==0 ? 'style="display:none"' : '');?>>
            <p><strong>Willing to donate to Aam Aadmi Party? </strong> <br />
                <input type="radio" name="donate" value="1" id="donate1" /> Yes &nbsp;&nbsp;
                <input type="radio" name="donate" value="0" id="donate2" checked="checked"/> No </p>
        </div>
        <?php if($additionalinfo!='')echo '<p>'.$additionalinfo.'</p>';?>
    </div>
    <p style="margin-bottom:0; padding-bottom:0"><strong>Comments: </strong> <span class="char"><span id="count">Characters left: 140</span></span><br />
    <textarea name="comments" id="comments" class="txt-area" rows="2" style="width:80%"></textarea></p>
</div>

<div style="float:left">      <input name="button" type="submit" class="leftformbt"   id="button" value="Submit" /></div>
    <div style="float:right"><a href="how-to-judge.php" class="report1" rel="colorbox9" style="float:right; color:#990000; font-weight:bold">Tips - How to Judge?</a></div>
	<div style="clear:both"></div>
</form>
</div>
    <?php } ?>
			<?php $query="select * from ".$tablename."   where iscalled=3 and userid=".$_SESSION["userid"]; 			
		   		$res=mysqli_query($mysqli, $query); 
				// echo $query;
			if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                               <p class="norecords">No Caller's List</p>
                                <?php  }
								else
								{ ?>
									 <table class="tblclass" width="100%">
    	<tr>
        <th width="45">S.no</th>
        <th width="150">Contact Name</th>
        <th width="75">Contact No</th>
        <th width="75">Contact Date</th>
        <th width="75">City</th>
        <th width="200">Comments</th>
		<th width="70">Call</th>
        </tr>
        <?php
						   $cnt=0;
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
        <tr>
        	<td ><?php echo $cnt ?></td>
        	<td><strong><?php echo $row['contactname'];?></strong></td>
        	<td><?php echo $row['contact'];?></td>
        	<td><?php echo dateformat2($row['contactdate']);?></td>
            <td><?php echo $row['address'];?></td>
            <td><?php echo $row['comments'];?></td>
            <td><a href="call-later.php?rid=<?php echo $row['id'];?>&action=call">Call Again</a></td>
        </tr>
        <?php } ?>
    </table><?php }?>
    <div class="clearfix p7"></div>
          <div class="clearfix l-r-p10 t-c hidden-desktop" align="center">
<img src="../images/aap-logo.png" />
</div>
<?php } else {?>
<p class="talkingtime">The call campaign is taking place between 8.00AM India Time to 10.00PM India Time. <br />
Thank you for your continued support!</p>
            <?php }?></div>
</div></div>
 <?php include("includes/footer.php");?>           
           </body>
</html>
