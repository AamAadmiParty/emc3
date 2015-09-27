<?php include("includes/app_top.php");
$campaign = $_SESSION['campaign'];
$campaigninfo = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * from campaigns where name='$campaign'"));
$constituency = $campaigninfo['constituency'];
$helpline = $campaigninfo['helpline'];
?>
<style type="text/css">
a.minimize{
    background-color: #000;
display: block;
height: 20px;
width:20px;
background: #003399 url('../images/nav_plus_white.png') no-repeat top;
}


#top_nav a.minimize{
position: absolute;
right:0px;
bottom:-20px;
z-index: 20;
}

#top_nav a.minimize_closed{
background: #003399 url('../images/nav_minus_white.png') no-repeat top;
}


#top_nav a.minimize span,
#top_nav a.minimize_closed span
{
display: none;
}
#top_nav.closed {
margin-top: -65px;
}
#container {
margin: 0 auto;
position: relative;
width: 1000px;
}
</style>

<div id="wrapper">
  <div id="adminheader">
  <div class="hidden-phone">
  <div id="container">
  <div id="top_nav" class="">
		<a href="#" class="minimize minimize_closed"><span>minimize</span></a>
    <div id="adminheader-bg">
      <div id="header">
        <div id="header-inner" class="mobile-t-c"> 
      
            <div class="mobile-header clearfix">
             <div class="mobile-col1 clearfix hidden-desktop hidden-tablet">
         <span class="pull-left t-m15" > <a href="#menu" class="blue-bg lrp25 tbp30 menu-link"> 
                <span class="icon-bar b-m7"></span>
                <span class="icon-bar b-m7"></span>
                <span class="icon-bar"></span> </a>
                </span>
             </div>
              
           <div class="mobile-col2 clearfix mobile-t-c">
            <a href="../index.php" class="home"><img src="../images/aap-logo2.png" alt="Citizen Call Campaign" /></a>
             
                <?php if(isset($_SESSION["userid"])!="")
			 {?>  <div class="memberselect2 hidden-phone">
                <div class="block-mini-3"> <a href="feedback.php" class="but report1"><img src="../images/feedback.png" alt="" title="" class="vol" /> <span class="span-2 l-m10">Suggestions/<br />
Feedback</span> </a></div>
               <div class="block-mini-4 "> <a href="report.php" class="but bn report1"><img src="../images/report.png" alt="" title="" class="vol" /> <span class="span-2 l-m10">Report <br />
              Problem</span> </a></div>
                    </div>
                    <div class="memberselect21">My Call Stats: Today (<b><?php
                    $sql9="SELECT COUNT(id) as cnt, userid FROM  ".$tablename." WHERE date(contactdate)='".$date2."' and userid=".$_SESSION['userid'];
                    //echo $sql9;
                    $res9=mysqli_query($mysqli, $sql9);
                    $row9=mysqli_fetch_assoc($res9);
                    $todaycalls=$row9['cnt'];
                    echo $todaycalls;?></b>) / Total (<b><?php $sql9="SELECT COUNT(id) as cnt from ".$tablename." WHERE userid=".$_SESSION['userid'];
                    $res9=mysqli_query($mysqli, $sql9);$row9=mysqli_fetch_assoc($res9);
                    $overall=$rowra['cnt']+$row9['cnt'];
                    echo $overall;?></b>)</div>
                    <?php }
			 else
			 {?>
                <div style="float:right; padding-top:20px; display:none" class="hidden-phone" >
				 <a  title="What is this program about??" class="video2 button4" href="http://www.youtube.com/v/j2GS5goYdw8?autoplay=1" rel="colorbox">What is this program about??</a></div>
                <div style="float:right; padding-top:5px" >
<?php if($helpline!='') {?>
    <span class="button4" style="display:block; text-align:center;"><span style="font-size:16px; line-height:24px">Helpline For Callers</span><br /><?php echo $helpline; ?></a></span>
<?php }?>
				  <div align="center" style="display:block; padding-top:5px; font-weight:bold; "> <a href="feedback2.php" class="report2" style="color:#FF0000" >Report Issues / Feedback</a></div>
				 <?php
				 }
			 ?>
          </div>
          </div>
          </div>
          </div>
        </div>
        </div>
        </div>
      </div>
<div class="hidden-desktop hidden-tablet">  
    <div id="adminheader-bg">
      <div id="header">
        <div id="header-inner" class="mobile-t-c"> 
      
            <div class="mobile-header clearfix">
             <div class="mobile-col1 clearfix hidden-desktop hidden-tablet">
         <span class="pull-left t-m15" > <a href="#menu" class="blue-bg lrp25 tbp30 menu-link"> 
                <span class="icon-bar b-m7"></span>
                <span class="icon-bar b-m7"></span>
                <span class="icon-bar"></span> </a>
                </span>
             </div>
              
           <div class="mobile-col2 clearfix mobile-t-c">


                <?php if(isset($_SESSION["userid"])!="")
			 {?>  <div class="memberselect2 hidden-phone">
                <div class="block-mini-3"> <a href="feedback.php" class="but report1"><img src="../images/feedback.png" alt="" title="" class="vol" /> <span class="span-2 l-m10">Suggestions/<br />
Feedback</span> </a></div>
               <div class="block-mini-4 "> <a href="report.php" class="but bn report1"><img src="../images/report.png" alt="" title="" class="vol" /> <span class="span-2 l-m10">Report <br />
              Problem</span> </a></div>
                    </div>
    <div class="memberselect21">My Call Record: Today (<b><?php
             $sql9="SELECT COUNT(id) as cnt, userid FROM  ".$tablename." WHERE date(contactdate)='".$date2."' and userid=".$_SESSION['userid'];
					//echo $sql9;
					 	$res9=mysqli_query($mysqli, $sql9);
						$row9=mysqli_fetch_assoc($res9);
						$todaycalls=$row9['cnt'];
						echo $todaycalls;?></b>) / Total (<b><?php $sql9="SELECT COUNT(id) as cnt from ".$tablename." WHERE userid=".$_SESSION['userid'];
$res9=mysqli_query($mysqli, $sql9);$row9=mysqli_fetch_assoc($res9);
$overall=$rowra['cnt']+$row9['cnt'];
echo $overall;?></b>)</div>
                    <?php }
			 else
			 {?>
				  <div align="center" style="display:block; padding-top:40px; font-weight:bold; "> <a href="feedback2.php" class="report2" style="color:#FF0000" >Suggestions / Feedback</a></div>
				 <?php
				 }
			 ?>
          </div>
          </div>
          </div>
          
        </div>
      </div>
      </div>
      </div>
      <?php if(isset($_SESSION["userid"])!="") {?>
      <div id="menu" class="menu clearfix" >
             <ul>
             <li><a href="details.php" title="Get Contact Details">Call</a> </li>    
             <!--<li><a href="referrals.php" title="Referrals">Referrals</a></li>
             <li><a href="call-later.php" title="Call Later">Call Later</a></li>-->
             <li><a href="contacts-list.php" title="Contacts">Call History</a></li>             
             <li><a href="dashboard.php" title="Dashboard">Leaderboard</a></li>
             <li><a href="view-profile.php" title="View Profile">Profile</a></li>
             <!--<li><a href="faqs.php" title="FAQS">FAQS</a></li>-->
             <li class="nolink"> Hi <b><?php echo $_SESSION["user"];?></b>, <a href="logout.php" title="Log Out">Log Out</a> </li>
             </ul>
             </div>
             <?php } ?>
    </div>
  </div>
</div>

<div class="clear"></div>
<div id="body-wrapper">
<div id="body-inner">


<div class="clear"></div>
<div id="sharestart"></div>
<?php if(isset($_SESSION["userid"])!="")
			 {?>
<?php
    $interval = 120;
    $filename = "cache/news.cache";
    // serve from the cache if less than 30 minutes have passed since the file was created
    if (file_exists($filename) && (time() - $interval) < filemtime($filename)) {
        readfile($filename);
        // Terminate so we don't regenerate the page.
    }
    else {
        ob_start();
        // This function saves all output to a buffer instead of outputting it directly.
    ?>

<div class="hidden-phone hidden-tablet">
<script type="text/javascript">
    var pausecontent1=new Array();
    var pausecontent2=new Array();
    <?php
    $j=0;
    $sql9="SELECT COUNT(id) as cnt, userid FROM $tablename WHERE date(contactdate)='$date2' group by userid order by cnt desc limit 10";
    $res9=mysqli_query($mysqli, $sql9);
    while($row9=mysqli_fetch_assoc($res9))
    {
        $desc="<b>SALUTE:</b> At ";
        $desc=$desc.OrdinalNumber($j+1);
        $uname=return_field('users','id',$row9['userid'],'name');
        $desc=$desc." position today is ".$uname.", with ".$row9['cnt']." calls!";
        ?>
        pausecontent1.push("<?php echo $desc;?>");
        <?php
        $j++;
    }
    $query9="select * from news where status2=1 and state_id=$stateid order by rand()";
	$result9=mysqli_query($mysqli, $query9);
    while($row9=mysqli_fetch_assoc($result9))
    {
        $desc=json_encode($row9['description']);
        $desc=substr($desc, 0, -1);
        $desc=substr($desc, 1);
        $imgsrc=$row9['imgsrc'];
        if($imgsrc!="")
        {
            $imgsrc="pictures/news/".$imgsrc;
            $desc="<img src='".$imgsrc."' alt='".$uname."' title='' width='30' height='30' />&nbsp;".$desc;
        }
        $j++;
        ?>
        pausecontent2.push("<?php echo $desc;?>");
        <?php
    }
    if($j>1){?>
        var pausecontent=new Array();
        for (var i=0; i < Math.max(pausecontent1.length,pausecontent2.length); i++) {
            if (i<pausecontent2.length)
                pausecontent.push(pausecontent2[i]);
            if (i<pausecontent1.length)
                pausecontent.push(pausecontent1[i]);
        }
        //new pausescroller(name_of_message_array, CSS_ID, CSS_classname, pause_in_miliseconds)
        new pausescroller9(pausecontent, "pscroller9", "someclass", 5000)
    <?php } ?>
</script>

            </div>
            <?php
            $buff = ob_get_contents();
          // Retrive the content from the buffer
          // Write the content of the buffer to the cache file
            $file = fopen($filename, "w");
            fwrite($file, $buff);
            fclose($file);
            ob_end_flush();
          // Display the generated page.
		  }
          ?>
            <?php } ?>
            <div id="middle"> 
            <div class="inner-division">     
<script type="text/javascript">
$(document).ready(function(){
    $("#top_nav a.minimize").click(function(){
     $("#top_nav").toggleClass('closed', 800);
     $(this).toggleClass('minimize_closed');
     });
});
</script> 
            