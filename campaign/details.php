<!doctype html>
<?php
    include("includes/app_top.php");
    include("includes/styles.php");
    
    checkUserLogin();
    $campaign = $_SESSION['campaign'];
    $campaigninfo = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT *, if(now()<date_add(date_sub(election_date,interval 2 day),interval 18 hour),0,1) as cutoff,DATE_FORMAT(date_add(date_sub(election_date,interval 2 day),interval 18 hour),'%M %D, %Y at %l%p') as cutoff_time from campaigns where name='$campaign'"));
    $constituency = $campaigninfo['constituency'];
    $cutoff = intval($campaigninfo['cutoff']);
    $cutoff_time = $campaigninfo['cutoff_time'];
    $options=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * from categories where id=".$categoryid));
    $rogue=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT status2 from users where id=".$_SESSION["userid"]));
    if ($rogue['status2']==2)
        header("location:logout.php");
    $daystart=$date2." 07:00:00";
    $dayend=$date2." 22:00:00";
    $date = date_default_timezone_set('Asia/Kolkata');
    $now=date("Y-m-d G:i:s");
    $cid=$_GET['cid'];
?>
<meta property="og:title" content="Mission C-Cube"/>
<link rel="stylesheet" href="../css/autocomplete.css" type="text/css" media="screen">
<link rel="stylesheet" href="../css/jquery-ui.css">
<script src="../js/autocomplete.js" type="text/javascript"></script>
<script src="../js/ajax.js" type="text/javascript"></script>
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery-ui.js"></script>

<?php
    if($action=="send")
    {
        $talk=cleanQuery($_POST['talk']);
        $whynot=cleanQuery($_POST['whynot']);
        $vote=cleanQuery($_POST['vote']);
        $comments=cleanQuery($_POST['comments']);
        $_SESSION['getcontact']='';
        $getid=cleanQuery($_POST['cid']);
        if($talk==1 and $vote>2)
        {
            $talk = 0;
            if ($vote==3)
                $whynot=3;
            if ($vote==4)
                $whynot=2;
        }
        if($talk==1)
        {
            $query="update $tablename set userid=".$_SESSION['userid'].", iscalled=$talk, contactdate='$now', vote=$vote, comments='$comments' where id=".$getid;
        }
        else
        {
            $query="update $tablename set userid=".$_SESSION['userid'].", iscalled=$whynot, contactdate='$now', comments='$comments' where id=".$getid;
        }
        mysqli_query($mysqli, $query) or die(mysqli_error());
        tep_redirect("details.php?action=m1");
    }
    include("../includes/colorbox.php");
?>
</head>
<body>
<?php
    include("includes/header.php");

    $message="";
    if($overall==1000)
    $message = "1000 CALLS!!! WE ARE ALL INSPIRED BY YOUR STELLAR EFFORT AND WE SALUTE YOU!!";
    else if($overall==750 || $todaycalls==750)
    $message = "750 CALLS!!! YOU ARE UNSTOPPABLE!! WHAT DEDICATION!";
    else if($overall==500 || $todaycalls==500)
    $message = "500 CALLS!!! YOU ARE DEFINITELY AN INSPIRATION TO OTHER CALLERS!!";
    else if($overall==250 || $todaycalls==250)
    $message = "250 CALLS!!! KEEP GOING LIKE THIS AND YOU WILL SOON BE IN THE TOP 10 LEADERBOARD!!";
    else if($overall==100 || $todaycalls==100)
    $message = "100 CALLS!!! YOU'RE IN FULL FORM! CONGRATS ON THE CENTURY!!";
    else if($overall==50 || $todaycalls==50)
    $message = "50 CALLS!!! CHANCE OF A CENTURY!?";
    else if($overall==25 || $todaycalls==25)
    $message = "25 CALLS!!! LOOKS LIKE YOU ARE SETTLING IN. HOW ABOUT A FIFTY!";
    else if($overall==10 || $todaycalls==10)
    $message = "GREAT! YOU HAVE STARTED YOUR INNINGS AND MADE 10 CALLS! LETS KEEP IT GOING!";
?>
<div style="text-align:center;">
<?php
    echo '<div class="notice1" style="margin:0px; display:inline-block;">Everyone, the call campaign will end today at 6pm Indian Time! Please keep the calls short today (1-2 mins) and make sure to tell the voters to "press the jhaadu symbol". Lets give our 100% in this last leg! Also, kudos to one of our fellow callers, Mrs Jaskirat Mann from Vancouver, for taking the AVAM liars to task in the media and proving that a lie has no legs to stand upon. We are proud to have you amongst us! </div>';
    if ($message!="")
        echo "<div class=\"notice1\" style=\"margin:0px; display:inline-block;\" ><b><span class=\"maroon\">NEW MILESTONE: </span>$message</b></div>";
    if ($campaigninfo['notices']!="")
        echo "<div class=\"notice1\" style=\"margin:0px; display:inline-block;\" >".$campaigninfo['notices'],"</div>";
?>
</div>
<?php
    $interval = 900;
    $filename = "cache/count.cache";
    if (file_exists($filename) && (time() - $interval) < filemtime($filename)) {
        readfile($filename);
    }
    else {
    ob_start();
    //if ($categoryid==102 || $categoryid==95 || $categoryid==109 || !isset($_SESSION['usercatid'])) {
        $res1=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=1 and userid !=0 and iscalled=1");
        $yes=mysqli_fetch_assoc($res1);
        $res2=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=0 and userid !=0 and iscalled=1");
        $no=mysqli_fetch_assoc($res2);
        $res3=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=2 and userid !=0 and iscalled=1");
        $und=mysqli_fetch_assoc($res3);
        $res4=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled>1");
        $row4=mysqli_fetch_assoc($res4);
    /*
    } else {
        $res1=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=1 and userid !=0 and iscalled=1 and catid=$categoryid");
        $yes=mysqli_fetch_assoc($res1);
        $res2=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=0 and userid !=0 and iscalled=1 and catid=$categoryid");
        $no=mysqli_fetch_assoc($res2);
        $res3=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=2 and userid !=0 and iscalled=1 and catid=$categoryid");
        $und=mysqli_fetch_assoc($res3);
        $res4=mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled>1 and catid=$categoryid");
        $row4=mysqli_fetch_assoc($res4);
    }
    */
    ?>
    <div class="memberselect">
        <div class="lrp2 clearfix hidden-desktop hidden-tablet">
            <div class="row-fluid clearfix w-w-break">
                <div class="part-5 clearfix t-c font-w6 green-t">
                    Yes
                </div>
                <div class="part-5 clearfix t-c font-w6 red-t">
                    No
                </div>
                <div class="part-5 clearfix t-c font-w6 black-t">
                    Maybe
                </div>
                <div class="part-5 clearfix t-c font-w6 orange-t">
                    N/A
                </div>
                <div class="part-5 clearfix t-c font-w6 black-t">
                    Total
                </div>
            </div>
            <div class="clearfix t-p1">
            </div>
            <div class="row-fluid clearfix">
                <div class="part-5 clearfix">
                    <div class="green-bg t-c white-t font18 t-b-p5 clearfix"><?php echo $yes['cnt']; ?></div>
                </div>
                <div class="part-5 clearfix">
                    <div class="red-bg t-c white-t font18 t-b-p5 clearfix"><?php echo $no['cnt']; ?></div>
                </div>
                <div class="part-5 clearfix">
                    <div class="gray-bg t-c black-t font18 t-b-p5 clearfix"><?php echo $und['cnt']; ?></div>
                </div>
                <div class="part-5 clearfix">
                    <div class="orange-bg t-c black-t font18 t-b-p5 clearfix"><?php echo $row4['cnt']; ?></div>
                </div>
                <div class="part-5 clearfix">
                    <div class="blue-bg t-c black-t font18 t-b-p5 clearfix"><?php echo $yes['cnt']+$no['cnt']+$und['cnt']+$row4['cnt']; ?></div>
                </div>
            </div>
        </div>

        <table  border="0" cellpadding="0" cellspacing="0" align="center" class="hidden-phone">
            <tr>
                <td width="63" class="yesfont">YES</td>
                <td width="63" class="nofont">NO</td>
                <td width="98" class="undedidefont">UNDECIDED</td>
                <td width="165" class="greenfont14" style="font-size:14px">BUSY/WRONG</td>
                <td width="135" class="bluefont14" style="font-size:16px">TOTAL CALLED</td>
            </tr>
            <tr>
                <td><span class="yesbt"><?php echo $yes['cnt']; ?></span></td>
                <td><span class="nobt"><?php echo $no['cnt']; ?></span></td>
                <td><span class="undecidebt"><?php echo $und['cnt']; ?></span></td>
                <td><span class="totalcallbt" style="display:inline-block; width:165px"><?php echo  $row4['cnt']; ?></span></td>
                <td><span class="totalcontactbt" style="display:inline-block; width:135px"><?php echo $yes['cnt']+$no['cnt']+$und['cnt']+$row4['cnt']; ?></span></td>
            </tr>
        </table>
    </div>
<?php
    $buff = ob_get_contents();
    $file = fopen($filename, "w");
    fwrite($file, $buff);
    fclose($file);
    ob_end_flush();
	} 
?>
    <div style="text-align:center;">
        <div class="get-connect-conatiner" style="width:auto; padding:0px; display:inline-block;">
            <div class="block-mini-2 bg-grey" style="text-align:center; min-height:0px; height:auto; font-size:14px; padding:5px; margin:0px; float:none;">
                <a href="message-to-citizen.php" class="detailspopup" rel="colorbox5">
                <b style="color:red; font-size:20px;">CLICK HERE FOR IMPORTANT INSTRUCTIONS</b></a>
                <br/><b><a href="delhidialogue.php" class="detailspopup" rel="colorbox5">DELHI DIALOGUE BLUEPRINT</a>
                &nbsp;&#124;&nbsp;
                <a href="http://my.aamaadmiparty.org/candidate/election/2.html" class="detailspopup" rel="colorbox5">CANDIDATE PROFILES</a>
                &nbsp;&#124;&nbsp;
                <a href="how-to-judge.php" class="detailspopup" rel="colorbox5">CANDIDATE HELPLINES</a>
                &nbsp;&#124;&nbsp;
                <a href="tips.php" class="detailspopup" rel="colorbox5">TIPS FOR CALLERS</a></b>
                <br/>
<?php
    if($cutoff) {?>
                <div class="notice2">
                    As per Election Commission norms, the Call Campaign for <?php echo $constituency; ?> was <strong>Officially Closed</strong> as of
                    <strong><?php echo $cutoff_time; ?></strong> IST.
                </div>
            </div>
        </div>
    </div>
<?php
    } else if(!check_date_is_within_range($daystart, $dayend, $now)) {?>
                <p class="talkingtime">
        The calling campaign takes place between 8:00AM to 9:00PM India Time. Please come back during those hours.<br />
                Thank you for your efforts!</p>
            </div>
        </div>
    </div>
<?php
    } else {
                if(isset($action)&&$action=="") { ?>
                <form method="post" name="getcontact" id="getcontact" action="details.php?action=m0">
                    <input name="submit1" type="submit" class="cont" id="submit1" value="Get Number To Call" style="margin-top:5px;"/>
                </form>
            <?php } ?>
            </div>
        </div>
    </div>
<?php
    if(isset($action)&&$action!="")
    {
        if(isset($cid)&&$cid!="")
        {
            $sql1="SELECT *,if(length(contact)=10,concat(\"+91 \",substr(contact,1,3),\"-\",substr(contact,4,3),\"-\",substr(contact,7,4)),contact) as contactnumber FROM $tablename WHERE id=$cid and userid=".$_SESSION['userid'];
        }
        else if(isset($_SESSION['getcontact'])&&$_SESSION['getcontact']!='')
        {
            $contactid=$_SESSION['getcontact'];
            $sql1="SELECT *,if(length(contact)=10,concat(\"+91 \",substr(contact,1,3),\"-\",substr(contact,4,3),\"-\",substr(contact,7,4)),contact) as contactnumber FROM $tablename WHERE id=$contactid";
        }
        else
        {
            $sql1="SELECT *,if(length(contact)=10,concat(\"+91 \",substr(contact,1,3),\"-\",substr(contact,4,3),\"-\",substr(contact,7,4)),contact) as contactnumber FROM $tablename WHERE catid=$categoryid and iscalled=0 order by rand() limit 1";
        }
        $res=mysqli_query($mysqli, $sql1);
        
        echo '<div style="text-align:center;">';
        echo '<div id="messages" style="width:auto; padding:0px; margin:0px; text-align:center; display:inline-block;">';
        if($action=="m0")
            echo '<div class="success">Here is a number. Call using your phone.</div>';
        if($action=="m1")
            echo '<div class="success">Details saved successfully. Here is a new number.</div>';
        if($action=="m2")
            echo '<div class="success">Here is the number you want to edit call details for.</div>';
        if(mysqli_num_rows($res)==0)
            echo '<div class="error">Numbers not available. Please check back later or <a href="edit-profile.php">Edit Profile</a> to choose another dataset. Thanks</div>';
        echo '</div></div>';
        
        if(mysqli_num_rows($res)!=0)
        {
        $row=mysqli_fetch_assoc($res);
        $_SESSION['getcontact']=$row['id'];
        ?>
        <div class="clear">
        </div>
        <table class="tabc" align="center" >
            <tr>
                <th>Phone Number:</th>
                <td><?php echo "<a href=\"tel:".$row['contactnumber']."\">".$row['contactnumber']."</a>";?></td>
                <td>(<?php echo ($row['address']!='')?$row['address']:$row['city'];?>)</td>
            </tr>
            <?php
            if ($row['contactname']!='')
                echo '<tr><th>Name:</th><td>'.$row['contactname'].'</td><td></td></tr>';
            ?>
        </table>

        <div style="text-align:center;">
        <div class="checklist" style="width:auto; padding:10px 0px; margin:0 auto; display:inline-block; text-align:center;">
            <form method="post" action="details.php?action=send" onsubmit="return validate()">
            <input type="hidden" name="cid" value="<?php echo $row['id'];?>" />
            <div id="talk">
                <p><strong>Did the call connect?<br/>
                <input type="radio" id="talk1" name="talk" value="1" onClick="check1();" ><label for="talk1">Yes</label>
                <input type="radio" id="talk2" name="talk" value="0" onClick="check1();" ><label for="talk2">No</label></p>
            </div>
            <div id="whynot" style="display:none">
                <p><strong>Why not?</strong><br />
                <input type="radio" id="whynot1" name="whynot" value="3" onClick="check2();"><label for="whynot1">Didnt Pickup</label>
                <input type="radio" id="whynot2" name="whynot" value="3" onClick="check2();"><label for="whynot2">Phone Engaged</label>
                <input type="radio" id="whynot3" name="whynot" value="4" onClick="check2();"><label for="whynot3">Switched Off</label>
                <input type="radio" id="whynot4" name="whynot" value="2" onClick="check2();"><label for="whynot4">Out-of-Range</label>
                <input type="radio" id="whynot5" name="whynot" value="2" onClick="check2();"><label for="whynot5">Out-of-Service</label></p>
            </div>
            <div id="voter" style="display:none">
                <div id="vote">
                    <p><strong>Will he/she vote for AAP? </strong><br />
                    <input type="radio" name="vote" value="1" id="vote1" onClick="check3();"/><label for="vote1">Yes</label>
                    <input type="radio" name="vote" value="0" id="vote2" onClick="check3();"/><label for="vote2">No</label>
                    <input type="radio" name="vote" value="2" id="vote3" onClick="check3();"/><label for="vote3">Undecided</label>
                    <input type="radio" name="vote" value="3" id="vote4" onClick="check3();"><label for="vote4">Not Free To Talk</label>
                    <input type="radio" name="vote" value="4" id="vote5" onClick="check3();"><label for="vote5">No Voter ID</label>
                    <input type="radio" name="vote" value="4" id="vote6" onClick="check3();"><label for="vote6">Not From Delhi</label></p>
                </div>
            </div>
            <p style="margin-bottom:0; padding-bottom:0">
                <strong>Comments: </strong> <span class="char">
                <span id="count">Characters left: 140</span></span><br/>
                <textarea name="comments" id="comments" class="txt-area" rows="2" style="width:70%"></textarea>
            </p>
                <input name="submit2" type="submit" class="leftformbt" id="submit2" value="Submit And Get Next Number" />
            </form>
        </div>
        </div>
<?php
        }
    }
}
include("includes/footer.php");
?>

<script type="text/javascript">
    function check1() {
        if($("input:radio[name='talk']:checked").val()=="1")
        {
            document.getElementById("voter").style.display="block";
            document.getElementById("whynot").style.display="none";
        }
        else
        {
            document.getElementById("voter").style.display="none";
            document.getElementById("whynot").style.display="block";
        }
    }
    function check2() {
        $whynotid = $("input:radio[name='whynot']:checked").attr('id');
        $labeltext = $("label[for="+$whynotid+"]").text();
        $("#comments").val($labeltext);
    }
    function check3() {
        $voteid = $("input:radio[name='vote']:checked").attr('id');
        $labeltext = $("label[for="+$voteid+"]").text();
        $("#comments").val($labeltext);
    }
    function validate()
    {
        if (!$("input:radio[name='talk']").is(":checked") ||
            ($("input:radio[name='talk']:checked").val()=="0" && !$("input:radio[name='whynot']").is(":checked")) ||
            ($("input:radio[name='talk']:checked").val()=="1" && !$("input:radio[name='vote']").is(":checked")))
        {
            alert('Please fill call details first!');
            return false;
        }
        else
            return true;
    }
    $(document).ready(function(){
        $("#comments").keyup(function(){
           maxlength=140;
           if($(this).val().length > maxlength){
           $(this).val($(this).val().substr(0,maxlength));
           }
           $("#count").text("Characters left: " + (maxlength - $(this).val().length));
           });
        $("#talk").buttonset();
        $("#whynot").buttonset();
        $("#vote").buttonset();
    });
</script>
</body>
</html>
