<div id="wrapper">
  <div id="adminheader">
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
            <a href="index.php" class="home"><img src="images/logo.png" alt="Citizen Call Campaign" /></a>
            <div id="countdown" class="hidden-phone hidden-tablet">
             	<div class="launching">Delhi Elections in</div>

            	<p id="time" class="time"></p>

            </div>
                <?php if(isset($_SESSION["userid"])!="")
			 {?>  <div class="memberselect2 hidden-phone">
                <div class="block-mini-3"> <a href="feedback.php" class="but report1"><img src="images/feedback.png" alt="" title="" class="vol" /> <span class="span-2 l-m10">Suggestions/<br />
Feedback</span> </a></div>
               <div class="block-mini-4 "> <a href="report.php" class="but bn report1"><img src="images/report.png" alt="" title="" class="vol" /> <span class="span-2 l-m10">Report <br />
              Problem</span> </a></div>
                    </div>
                    <div class="memberselect21">Called&nbsp;Today / Total: <b><?php
             $sql9="SELECT COUNT(id) as cnt, userid FROM  contacts WHERE date(contactdate)='".$date2."' and userid=".$_SESSION['userid'];
					//echo $sql9;
					 	$res9=mysqli_query($mysqli, $sql9);
						$row9=mysqli_fetch_assoc($res9);
						$sqlra="SELECT COUNT(id) as cnt FROM  other_contacts WHERE date(contactdate)='".$date2."' and userid=".$_SESSION['userid'];
					//echo $sqlra;
					 	$resra=mysqli_query($mysqli, $sqlra);
						$rowra=mysqli_fetch_assoc($resra);
						$todaycalls=$rowra['cnt']+$row9['cnt'];
						echo $todaycalls;?>/<?php $sql9="SELECT COUNT(id) as cnt from contacts WHERE userid=".$_SESSION['userid'];
$res9=mysqli_query($mysqli, $sql9);$row9=mysqli_fetch_assoc($res9);
$overall=$rowra['cnt']+$row9['cnt'];
echo $overall;?></b> </div>
                    <?php }
			 else
			 {?>
                <div style="float:right; padding-top:20px; display:none" class="hidden-phone" >
				 <a  title="What is this program about??" class="video2 button4" href="http://www.youtube.com/v/j2GS5goYdw8?autoplay=1" rel="colorbox">What is this program about??</a></div>
                <div style="float:right; padding-top:5px" >
				 <span class="button4" style="display:block; text-align:center;"><span style="font-size:16px; line-height:24px">Call Delhi Voters</span><br />
 +91 7827 227 227</a></span> 

				  <div align="center" style="display:block; padding-top:5px; font-weight:bold; "> <a href="feedback2.php" class="report2" style="color:#FF0000" >Suggestions / Feedback</a></div>
				 <?php
				 }
			 ?>
          </div>
          </div>
          </div>
          
        </div>
      </div>
      <?php if(isset($_SESSION["userid"])!="") {?>
      <div id="menu" class="menu clearfix" >
             <ul>
             <li><a href="details.php" title="Get Contact Details">Get Contact</a> </li>    
             <li><a href="referrals.php" title="Referrals">Referrals</a></li>             
             <li><a href="call-later.php" title="Call Later">Call Later</a></li>  
             <li><a href="contacts-list.php" title="Contacts">Contacts</a></li>             
             <li><a href="dashboard.php" title="Dashboard">Dashboard</a></li>             
             <li><a href="view-profile.php" title="View Profile">Profile</a></li>
             <li><a href="faqs.php" title="FAQS">FAQS</a></li>
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
						<?php 
					
		$j=0;	 ?>
		
										//new pausescroller(name_of_message_array, CSS_ID, CSS_classname, pause_in_miliseconds)
										var pausecontent9=new Array();  
 <?php 
 
					 	$sql9="SELECT COUNT(id) as cnt, userid FROM  contacts WHERE date(contactdate)='".$date2."' group by userid order by cnt desc limit 10";
//	echo $sql9;
					 	$res9=mysqli_query($mysqli, $sql9);
						   while($row9=mysqli_fetch_assoc($res9))
				{  
				 
				$desc="Today's Leader of telecalling: ";
				if($j>0)
				$desc=$desc.OrdinalNumber($j+1);
				$imgsrc=return_field('users','id',$row9['userid'],'imgsrc');
				$uname=return_field('users','id',$row9['userid'],'name');
				if($imgsrc!="")
				{
				$imgsrc="pictures/members/".$imgsrc;
				$desc=$desc."&nbsp;<img src='".$imgsrc."' alt='".$uname."' title='' width='30' height='30' />&nbsp;";
				}
				$desc=$desc." <b>".$uname."  - ".$row9['cnt']."</b>";
			  ?> 
			  pausecontent9[<?php echo $j;?>]="<?php echo $desc;?>"
			  <?php 
			  $j++;	 
			  }  
 
 $query9="select * from news where status2=1 "; 
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
			 $desc="\"<span>".$desc."</span>\"";			 
			  ?> 
			  pausecontent9[<?php echo $j;?>]=<?php echo $desc;?>
			  <?php 
			  $j++;	 
			  }   
			  if($j>1){?> 
new pausescroller9(pausecontent9, "pscroller9", "someclass", 5000)
<?php } 
?>
</script>
            <abbr><span class="ne">Latest News</span></abbr>
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
                <div class="notice1" style="margin:10px 30px 0 30px;"><span class="maroon">Important Information:</span> Convey every voter about AAP Buzz Program. <a href="http://www.aamaadmiparty.org/buzz" target="_blank"><strong>Read Here</strong></a></div>       
            